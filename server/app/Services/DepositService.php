<?php

namespace App\Services;

use App\Models\AccountPlan;
use App\Models\Deposit;
use App\Models\DepositPlan;
use App\Models\SysInfo;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class DepositService
{
    protected $transactionService;
    protected $accountService;

    public function __construct(TransactionService $transactionService, AccountService $accountService)
    {
        $this->transactionService = $transactionService;
        $this->accountService = $accountService;
    }

    public function closeDay()
    {
        $deposits = Deposit::query()->where("amount", ">", 0)->get();
        foreach ($deposits as $deposit) {
            $end_date = Carbon::parse($deposit->end_date);
            $current_day = Carbon::parse(SysInfo::query()->first()->current_day);
            if ($current_day->gte($end_date) && $deposit->amount != 0) {
                $this->transactionService->commitTransaction(
                    $this->accountService->getDevelopmentFundAccount(),
                    $this->accountService->getMainAccount($deposit),
                    $deposit->amount
                );
                $deposit->amount = 0;
                $deposit->save();
            } else {
                $plan = DepositPlan::query()->where("id", $deposit->plan_id)->first();
                $this->transactionService->commitTransaction(
                    $this->accountService->getDevelopmentFundAccount(),
                    $this->accountService->getPercentAccount($deposit),
                    number_format(($deposit->amount * $plan->percent / 100) / 365, 4)
                );
            }

        }
    }

    public function createDeposit($data): Deposit
    {
        $depositPlan = DepositPlan::query()->findOrFail($data["plan_id"]);
        $accountPlan = AccountPlan::query()->first();
        list($mainAccount, $percentAccount) = $this->accountService->createDepositAccounts($accountPlan, $data["user_id"]);
        $now = SysInfo::query()->first()->current_day;
        $deposit = Deposit::query()->create([
            "start_date" => Carbon::parse($now)->toDateString(),
            "end_date" => Carbon::parse($now)->addDays($depositPlan->period_in_days)->toDateString(),
            "amount" => $data["amount"],
            "plan_id" => $depositPlan->id,
            "user_id" => $data["user_id"],
            "percent_account_id" => $percentAccount->id,
            "main_account_id" => $mainAccount->id
        ]);
        $this->transactionService->updateCashDeskDebit($this->accountService->getCashDeskAccount(), $data["amount"]);
        $this->transactionService->commitTransaction($this->accountService->getCashDeskAccount(), $mainAccount, $data["amount"]);
        $this->transactionService->commitTransaction($mainAccount, $this->accountService->getDevelopmentFundAccount(), $data["amount"]);
        return $deposit;
    }

    public function closeDeposit(int $id)
    {
        $deposit = Deposit::query()->findOrFail($id);
        $plan = DepositPlan::query()->findOrFail($deposit->plan_id);
        if (!$plan->revocable) {
            throw ValidationException::withMessages([
                'error' => 'The deposit must be revocable.'
            ]);
        }

        if ($deposit->amount == 0 || SysInfo::query()->first()->current_day > $deposit->end_date) {
            throw ValidationException::withMessages([
                "error" => 'Deposit is closed']);
        }
        $mainAccount = $this->accountService->getMainAccount($deposit);
        $percentAccount = $this->accountService->getPercentAccount($deposit);
        $this->transactionService->commitTransaction(
            $this->accountService->getDevelopmentFundAccount(),
            $mainAccount,
            $deposit->amount
        );
        $this->transactionService->commitTransaction(
            $mainAccount,
            $this->accountService->getCashDeskAccount(),
            $deposit->amount
        );
        $percents = $percentAccount->balance;

        $this->transactionService->commitTransaction(
            $percentAccount,
            $this->accountService->getCashDeskAccount(),
            $percents
        );
        $this->transactionService->updateCashDeskCredit($this->accountService->getCashDeskAccount(), $percents + $deposit->amount);
        $deposit->amount = 0;
        $deposit->save();
        return "Deposit closed";
    }
}

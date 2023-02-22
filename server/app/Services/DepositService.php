<?php

namespace App\Services;

use App\Models\AccountPlan;
use App\Models\Deposit;
use Carbon\Carbon;

class DepositService
{
    protected $transactionService;
    protected $accountService;

    public function __construct(TransactionService $transactionService, AccountService $accountService)
    {
        $this->transactionService = $transactionService;
        $this->accountService = $accountService;
    }

    public function createDeposit($data): Deposit
    {
        $plan = AccountPlan::query()->findOrFail($data["plan_id"]);

        list($mainAccount, $percentAccount) = $this->accountService->createDepositAccounts($plan);
        $now = Carbon::now();
        $deposit = Deposit::query()->create([
            "start_date" => $now->toIso8601String(),
            "end_date" => $now->addDays($plan->period_in_days)->toIso8601String(),
            "amount" => $data["amount"],
            "plan_id" => $plan->id,
            "user_id" => $data["user_id"],
            "percent_account_id" => $percentAccount->id,
            "main_account_id" => $mainAccount->id
        ]);
        $this->transactionService->commitCashDeskTransaction($this->accountService->getCashDeskAccount(), $data["amount"]);
        $this->transactionService->commitTransaction($this->accountService->getCashDeskAccount(), $mainAccount, $data["amount"]);
        $this->transactionService->commitTransaction($mainAccount, $this->accountService->getDevelopmentFundAccount(), $data["amount"]);
        return $deposit;
    }
}

<?php

namespace App\Services;

use App\Models\AccountPlan;
use App\Models\Credit;
use App\Models\CreditPlan;
use App\Models\SysInfo;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class CreditService
{
    protected TransactionService $transactionService;
    protected AccountService $accountService;

    protected AtmService $atmService;

    public function __construct($transactionService, $accountService, $atmService)
    {
        $this->transactionService = $transactionService;
        $this->accountService = $accountService;
        $this->atmService = $atmService;
    }

    public function withdrawCash($account, $amount)
    {
        if ($account->balance < $amount) {
            throw ValidationException::withMessages([
                'error' => 'Not enough money!'
            ]);
        }
        $this->transactionService->commitTransaction($account, $this->accountService->getCashDeskAccount(), $amount);
        $this->transactionService->updateCashDeskCredit($this->accountService->getCashDeskAccount(), $amount);
    }

    public function getAccountByCard($id)
    {
        $credit = Credit::query()->where("card_id", $id)->firstOrFail();
        return $this->accountService->getAccountById($credit->main_account_id);
    }

    public function createCredit($data)
    {
        $creditPlan = CreditPlan::query()->findOrFail($data["plan_id"]);
        $accountPlan = AccountPlan::query()->where("number", "2014")->first();
        list($mainAccount, $percentAccount) = $this->accountService->createAccounts($accountPlan, $data["user_id"]);
        $now = SysInfo::query()->first()->current_day;
        $credit = Credit::query()->create([
            "start_date" => Carbon::parse($now)->toDateString(),
            "period" => $data["period"],
            "end_date" => Carbon::parse($now)->addMonths($data["period"])->toDateString(),
            "amount" => $data["amount"],
            "plan_id" => $creditPlan->id,
            "user_id" => $data["user_id"],
            "percent_account_id" => $percentAccount->id,
            "main_account_id" => $mainAccount->id,
            "card_id" => $this->atmService->createCard()
        ]);
        $this->transactionService->commitTransaction($this->accountService->getDevelopmentFundAccount(), $mainAccount, $data["amount"]);
        return $credit;
    }

    private function getDifferentiatedPaymentPlan($plan, $period, $amount)
    {
        $payments = [];
        $payed = $amount / $period;
        $percent = $plan->percent / 100;
        $now = Carbon::now();
        for ($i = 0; $i < $period; $i++) {
            $date = $now->addMonth()->format('Y-m-d');
            $payments[$date] = $this->getMonthlyDifferentiatedPayment($amount, $percent, $now->daysInMonth);
            $amount -= $payed;
        }
        return $payments;
    }

    private function getMonthlyDifferentiatedPayment($amount, $percent, $days)
    {
        $year = 365;
        return $amount * $percent / $year * $days;
    }
    public function getPaymentPlan($id) {
        $credit = Credit::query()->findOrFail($id);
        $plan = CreditPlan::query()->findOrFail($credit->plan_id);
        $amount = $credit->amount;
        $period = $credit->period;
        $annuity = $plan->annuity;
        return $annuity ? $this->getAnnuityPaymentPlan($plan, $period, $amount)
            : $this->getDifferentiatedPaymentPlan($plan, $period, $amount);
    }
    private function getAnnuityPaymentPlan($plan, $period, $amount)
    {
        $monthly_payment = $this->getMonthlyAnnuityPayment($period, $amount, $plan->percent);
        $now = Carbon::now();
        return array_fill_keys(
            array_map(
                function () use ($now) {
                    return $now->addMonth()->format('Y-m-d');
                },
                range(0, $period)
            ),
            $monthly_payment
        );
    }

    private function getMonthlyAnnuityPayment($period, $amount, $percent)
    {
        $rate = ($percent / 100) / 12;
        return ($amount * $rate * pow((1 + $rate), $period)) / (pow((1 + $rate), $period) - 1);
    }

    public function closeDay()
    {
        $credits = Credit::query()->where("amount", ">", 0)->get();
        foreach ($credits as $credit) {

            $end_date = Carbon::parse($credit->end_date);
            $current_day = Carbon::parse(SysInfo::query()->first()->current_day);
            if ($current_day->gte($end_date)) {
//                $this->transactionService->commitTransaction(
//                    $this->accountService->getMainAccount($credit),
//                    $this->accountService->getDevelopmentFundAccount(),
//                    $credit->amount
//                );
                $credit->amount = 0;
                $credit->save();
            } else {
                $plan = CreditPlan::query()->findOrFail($credit->plan_id);
                $amount = $plan->annuity ? $this->getDailyAnnuityPayment($credit->period, $credit->amount, $plan->percent)
                : $this->getDailyDifferentiatedPayment($credit->period, $credit->amount, $plan->percent);
                $this->transactionService->commitTransaction(
                    $this->accountService->getPercentAccount($credit),
                    $this->accountService->getDevelopmentFundAccount(),
                    $amount
                );
            }

        }
    }

    private function getDailyAnnuityPayment($period, $amount, $percent)
    {
        return ($this->getMonthlyAnnuityPayment($period, $amount, $percent) * $period - $amount) / ($period * 30);
    }

    private function getDailyDifferentiatedPayment($period, $amount, $percent)
    {
        $payments = 0;
        $payed = $amount / $period;
        $percent /= 100;
        $now = Carbon::now();
        for ($i = 0; $i < $period; $i++) {
            $payments += $this->getMonthlyDifferentiatedPayment($amount, $percent, $now->daysInMonth);
            $amount -= $payed;
        }
        return ($payments - $amount) / ($period * 30);
    }

}

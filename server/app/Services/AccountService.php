<?php

namespace App\Services;

use App\Models\Account;
use App\Models\AccountPlan;

class AccountService
{
    public function getAccountsByPlanId($accounts, $planId)
    {
        return collect($accounts)
            ->filter(fn($account) => $account['plan_id'] === $planId)
            ->map(function ($account) {
                $account['type'] = str_ends_with($account['number'], '0') ? 'main' : 'percent';
                return $account;
            });
    }

    public function getAccountByPlanId($accounts, $planId)
    {
        $account = collect($accounts)->firstWhere('plan_id', $planId);
        if (!$account) {
            return null;
        }
        return $account;
    }
    public function createDepositAccounts(AccountPlan $plan, $userId)
    {
        $mainAccount = $this->createAccount($plan, false, $userId);
        $percentAccount = $this->createAccount($plan, true, $userId);
        return [$mainAccount, $percentAccount];
    }

    public function createAccount(AccountPlan $plan, $isPercent, $userId)
    {
        return Account::query()->create([
                "number" => $this->generateAccountNumber($plan->number, $isPercent),
                "debit" => 0,
                "credit" => 0,
                "balance" => 0,
                "user_id" => $userId,
                "plan_id" => $plan->id
            ]
        );
    }

    private function generateAccountNumber($planNumber, $isPercent): string
    {
        $suffix = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        $suffix .= $isPercent ? '1' : '0';
        return $planNumber . $suffix;
    }

    public function getCashDeskAccount()
    {
        $plan = AccountPlan::query()->where("number", "1010")->firstOrFail();
        return Account::query()->where("plan_id", $plan->id)->firstOrFail();
    }

    public function getDevelopmentFundAccount()
    {
        $plan = AccountPlan::query()->where("number", "7327")->firstOrFail();
        return Account::query()->where("plan_id", $plan->id)->firstOrFail();
    }

    public function getPercentAccount($deposit) {
        return Account::query()->findOrFail($deposit->percent_account_id);
    }
    public function getMainAccount($deposit) {
        return Account::query()->findOrFail($deposit->main_account_id);
    }
}

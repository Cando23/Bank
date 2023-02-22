<?php

namespace App\Services;

use App\Models\Account;
use App\Models\AccountPlan;

class AccountService
{
    public function createDepositAccounts(AccountPlan $plan)
    {
        $mainAccount = $this->createAccount($plan, false);
        $percentAccount = $this->createAccount($plan, true);
        return [$mainAccount, $percentAccount];
    }

    public function createAccount(AccountPlan $plan, $isPercent)
    {
        return Account::query()->create([
                "number" => $this->generateAccountNumber($plan->number, $isPercent),
                "debit" => 0,
                "credit" => 0,
                "balance" => 0,
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
}

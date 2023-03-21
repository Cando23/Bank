<?php

namespace App\Services;

use App\Models\AccountPlan;
use App\Models\Transaction;

class TransactionService
{
    public function updateCashDeskDebit($account, $money)
    {
        $account->debit += $money;
        $account->balance = $account->debit - $account->credit;
        $account->save();
    }
    public function updateCashDeskCredit($account, $money)
    {
        $account->credit += $money;
        $account->balance = $account->debit - $account->credit;
        $account->save();
    }
    public function commitTransaction($debitAccount, $creditAccount, $money)
    {
        $calculateBalance = fn($account) => $account->debit - $account->credit;
        $calculateNegativeBalance = fn($account) => $account->credit - $account->debit;
        $debitPlan = AccountPlan::query()->findOrFail($debitAccount->plan_id);
        $creditPlan = AccountPlan::query()->findOrFail($creditAccount->plan_id);
        $debitPlan->type === "A" ? $this->updateAccountCredit($debitAccount, $money, $calculateBalance) : $this->updateAccountDebit($debitAccount, $money, $calculateNegativeBalance);
        $creditPlan->type === "A" ? $this->updateAccountDebit($creditAccount, $money, $calculateBalance) : $this->updateAccountCredit($creditAccount, $money, $calculateNegativeBalance);
        Transaction::query()->create([
            "debit_account_id" => $debitAccount->id,
            "credit_account_id" => $creditAccount->id,
            "amount" => $money
        ]);
    }

    private function updateAccountCredit($account, $money, $balance)
    {
        $account->credit += $money;
        $account->balance = $balance($account);
        $account->save();
    }

    private function updateAccountDebit($account, $money, $balance)
    {
        $account->debit += $money;
        $account->balance = $balance($account);
        $account->save();
    }
}

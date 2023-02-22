<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $accounts = Account::query()
            ->groupBy('accounts.plan_id', 'accounts.id')
            ->get()
            ->toArray();

        $passiveAccounts = $this->getAccountsByPlanId($accounts, 1);
        $activeAccounts = $this->getAccountsByPlanId($accounts, 2);
        $cashDeskAccount = $this->getAccountById($accounts, 3);
        $developmentFundAccount = $this->getAccountById($accounts, 4);
        return [
            'passive_accounts' => $passiveAccounts,
            'active_accounts' => $activeAccounts,
            'cash_desk_account' => $cashDeskAccount,
            'development_fund_account' => $developmentFundAccount
        ];
    }

    private function getAccountsByPlanId($accounts, $planId)
    {
        return collect($accounts)
            ->filter(fn($account) => $account['plan_id'] === $planId)
            ->map(function ($account) {
                $account['type'] = str_ends_with($account['number'], '0') ? 'main' : 'percent';
                return $account;
            })->toArray();
    }

    private function getAccountById($accounts, $accountId)
    {
        $account = collect($accounts)->firstWhere('id', $accountId);
        if (!$account) {
            return null;
        }
        return $account;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Account::query()->findOrFail($id);
    }
}

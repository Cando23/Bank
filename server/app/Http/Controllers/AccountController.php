<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\AccountService;

class AccountController extends Controller
{
    protected $accountService;
    public function __construct(AccountService$accountService)
    {
        $this->accountService = $accountService;
    }

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

        $passiveAccounts = $this->accountService->getAccountsByPlanId($accounts, 1)->values();
        $activeAccounts = $this->accountService->getAccountsByPlanId($accounts, 2)->values();
        $cashDeskAccount = $this->accountService->getAccountByPlanId($accounts, 3);
        $developmentFundAccount = $this->accountService->getAccountByPlanId($accounts, 4);
        return [
            'passive_accounts' => $passiveAccounts,
            'active_accounts' => $activeAccounts,
            'cash_desk_account' => $cashDeskAccount,
            'development_fund_account' => $developmentFundAccount
        ];
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

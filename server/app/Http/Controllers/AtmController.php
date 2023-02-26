<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Requests\CashWithdrawalRequest;
use App\Services\AtmService;
use App\Services\CreditService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class AtmController extends Controller
{
    protected $atmService;
    protected $creditService;

    public function __construct(AtmService $atmService, CreditService $creditService)
    {
        $this->atmService = $atmService;
        $this->creditService = $creditService;
    }

    public function auth(CardRequest $request)
    {
        $data = $request->validated();
        try {
            return ["id" => $this->atmService->validateCard($data)];
        } catch (ValidationException $e) {
            $error = $e->errors()["error"][0];
            return response()->json(['error' => $error], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = $this->creditService->getAccountByCard($id);
        return [
            "number" => $account->number,
            "balance" => $account->balance,
            "date" => Carbon::now()->toDateString(),
            "operation" => "Account balance"
        ];
    }
    public function withdraw(CashWithdrawalRequest $request)
    {
        $data = $request->validated();
        try {
            $id = $this->atmService->validateCard($data);
            $account = $this->creditService->getAccountByCard($id);
            $this->creditService->withdrawCash($account, $data["amount"]);
            return [
                "number" => $account->number,
                "amount" => $data["amount"],
                "date" => Carbon::now()->toDateString(),
                "operation" => "Cash withdrawal"
            ];
        } catch (ValidationException $e) {
            $error = $e->errors()["error"][0];
            return response()->json(['error' => $error], 422);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditPlanRequest;
use App\Http\Requests\StoreCreditRequest;
use App\Models\Card;
use App\Models\Credit;
use App\Rules\CheckCreditPeriod;
use App\Services\CreditService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    protected CreditService $creditService;

    public function __construct(CreditService $creditService)
    {
        $this->creditService = $creditService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index() : Collection
    {
        return Credit::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCreditRequest $request
     * @return Credit
     */
    public function store(StoreCreditRequest $request) : Credit
    {
        $data = $request->validated();
        return $this->creditService->createCredit($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Credit
     */
    public function show(int $id): Credit
    {
        return Credit::query()->findOrFail($id);
    }

    public function plan(Request $request){
        $validator = Validator::make($request->query(), [
            "annuity" => "required|boolean",
            "plan_id" => "required|exists:credit_plans,id|numeric",
            "amount" => "required|numeric|between:101.00,9999999999.99"
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $plan_id = $request->query("plan_id");
        $validator = Validator::make($request->query(), [
            "period" => ["required", "numeric", "gt:0", new CheckCreditPeriod($plan_id)]
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $amount = $request->query("amount");
        $period = $request->query("period");
        $annuity = $request->query("annuity");
        return $annuity ? $this->creditService->getAnnuityPaymentPlan($plan_id, $period, $amount)
            : $this->creditService->getDifferentiatedPaymentPlan($plan_id, $period, $amount);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditPlanRequest;
use App\Http\Requests\StoreCreditRequest;
use App\Models\Credit;
use App\Services\CreditService;
use Illuminate\Database\Eloquent\Collection;

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

    public function payment(int $id){
        return $this->creditService->getPaymentPlan($id);
    }
}

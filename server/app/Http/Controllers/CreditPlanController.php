<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditPlanRequest;
use App\Models\CreditPlan;
use Illuminate\Database\Eloquent\Collection;

class CreditPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index() : Collection
    {
        return CreditPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCreditPlanRequest  $request
     * @return CreditPlan
     */
    public function store(StoreCreditPlanRequest $request) : CreditPlan
    {
        $data = $request->validated();
        return CreditPlan::query()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CreditPlan
     */
    public function show($id) : CreditPlan
    {
        return CreditPlan::query()->findOrFail($id);
    }
}

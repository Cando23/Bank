<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositPlanRequest;
use App\Models\DepositPlan;
use Illuminate\Database\Eloquent\Collection;

class DepositPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return DepositPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepositPlanRequest $request
     * @return DepositPlan
     */
    public function store(StoreDepositPlanRequest $request): DepositPlan
    {
        $data = $request->validated();
        return DepositPlan::query()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DepositPlan
     */
    public function show(int $id): DepositPlan
    {
        return DepositPlan::query()->findOrFail($id);
    }
}

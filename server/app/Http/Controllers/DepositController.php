<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Models\Deposit;
use App\Services\DepositService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    protected $depositService;

    public function __construct(DepositService $depositService) {
        $this->depositService = $depositService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Deposit::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepositRequest $request
     * @return Deposit
     */
    public function store(StoreDepositRequest $request) : Deposit
    {
        $data = $request->validated();
        return $this->depositService->createDeposit($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Deposit
     */
    public function show(int $id) : Deposit
    {
        return Deposit::query()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

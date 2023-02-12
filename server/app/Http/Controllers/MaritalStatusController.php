<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaritalStatusRequest;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MaritalStatus::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MaritalStatus::query()->findOrFail($id);
    }
}

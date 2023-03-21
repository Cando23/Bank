<?php

namespace App\Http\Controllers;

use App\Models\Disability;
use Illuminate\Http\Request;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disability::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Disability::query()->findOrFail($id);
    }
}

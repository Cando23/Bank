<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource("users", \App\Http\Controllers\UserController::class);
Route::apiResource("cities", \App\Http\Controllers\CityController::class, ['except' => ['create', 'edit', 'remove']]);
Route::apiResource("statuses", \App\Http\Controllers\MaritalStatusController::class, ['except' => ['create', 'edit', 'remove']]);
Route::apiResource("citizenships", \App\Http\Controllers\CitizenshipController::class, ['except' => ['create', 'edit', 'remove']]);
Route::apiResource("disabilities", \App\Http\Controllers\DisabilityController::class, ['except' => ['create', 'edit', 'remove']]);

<?php

use App\Http\Controllers\CitizenshipController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DisabilityController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\UserController;
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
Route::apiResource("users", UserController::class);
Route::get("cities", [CityController::class, "index"]);
Route::get("cities/{city}", [CityController::class, "show"]);
Route::get("statuses", [MaritalStatusController::class, "index"]);
Route::get("statuses/{status}", [MaritalStatusController::class, "show"]);
Route::get("citizenships", [CitizenshipController::class, "index"]);
Route::get("citizenships/{citizenship}", [CitizenshipController::class, "show"]);
Route::get("disabilities", [DisabilityController::class, "index"]);
Route::get("disabilities/{disability}", [DisabilityController::class, "show"]);

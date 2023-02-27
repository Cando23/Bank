<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AtmController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CitizenshipController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditPlanController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositPlanController;
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

Route::prefix("deposits")->group(function () {
    Route::get("/plans", [DepositPlanController::class, "index"]);
    Route::get("/plans/{plan}", [DepositPlanController::class, "show"]);
    Route::post("/plans", [DepositPlanController::class, "store"]);
    Route::post("/", [DepositController::class, "store"]);
    Route::get("/", [DepositController::class, "index"]);
    Route::get("/{deposit}", [DepositController::class, "show"]);
    Route::post("/{deposit}/close", [DepositController::class, "close"]);
});

Route::prefix("bank")->group(function () {
   Route::post("/day", [BankController::class, "closeDay"]);
   Route::post("/month", [BankController::class, "closeMonth"]);
   Route::post("/year", [BankController::class, "closeYear"]);
});

Route::get("accounts", [AccountController::class, "index"]);
Route::get("accounts/{account}", [AccountController::class, "show"]);

Route::prefix("credits")->group(function () {
    Route::get("/plans", [CreditPlanController::class, "index"]);
    Route::get("/plans/{plan}", [CreditPlanController::class, "show"]);
    Route::post("/plans", [CreditPlanController::class, "store"]);
    Route::post("/", [CreditController::class, "store"]);
    Route::get("/", [CreditController::class, "index"]);
    Route::get("/{credit}/payment", [CreditController::class, "payment"]);
    Route::get("/{credit}", [CreditController::class, "show"]);
});

Route::get("cards/", [CardController::class, "index"]);
Route::get("cards/{card}", [CardController::class, "show"]);

Route::prefix("atm")->group(function () {
   Route::post("/", [AtmController::class, "auth"]);
   Route::get("/{card}", [AtmController::class, "show"]);
   Route::post("/withdraw", [AtmController::class, "withdraw"]);
});

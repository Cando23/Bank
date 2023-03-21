<?php

namespace App\Http\Controllers;

use App\Services\BankService;

class BankController extends Controller
{
    protected $bankService;
    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    public function closeDay(){
       return $this->bankService->closeDay();
   }
    public function closeMonth(){
        return $this->bankService->closeMonth();
    }
    public function closeYear(){
        return $this->bankService->closeYear();
    }
}

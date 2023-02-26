<?php

namespace App\Services;

use App\Models\SysInfo;
use Carbon\Carbon;
class BankService
{
    protected DepositService $depositService;
    protected CreditService $creditService;
    public function __construct($depositService, $creditService)
    {
        $this->depositService = $depositService;
        $this->creditService = $creditService;
    }

    public function closeDay(){
       $this->depositService->closeDay();
       $this->creditService->closeDay();
       $info = SysInfo::query()->first();
       $info->update(["current_day" =>  Carbon::parse($info->current_day)->addDay()]);
    }
    public function closeMonth(){
        $currentDay = Carbon::parse(SysInfo::query()->first()->current_day);
        $lastDayOfMonth = $currentDay->copy()->addMonth();
        while ($currentDay->lte($lastDayOfMonth)) {
            $info = SysInfo::query()->first();
            $this->depositService->closeDay();
            $this->creditService->closeDay();
            $currentDay->addDay();
            $info->update(["current_day" =>  Carbon::parse($info->current_day)->addDay()]);
        }
    }
    public function closeYear(){
        $currentDay = Carbon::parse(SysInfo::query()->first()->current_day);
        $lastDayOfYear = $currentDay->copy()->addYear();

        while ($currentDay->lte($lastDayOfYear)) {
            $info = SysInfo::query()->first();
            $this->depositService->closeDay();
            $this->creditService->closeDay();
            $currentDay->addDay();
            $info->update([
                "current_day" =>  Carbon::parse($info->current_day)->addDay()
            ]);
        }
    }
}

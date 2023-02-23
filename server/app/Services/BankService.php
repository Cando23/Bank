<?php

namespace App\Services;

use App\Models\SysInfo;
use Carbon\Carbon;
class BankService
{
    protected $depositService;
    public function __construct($depositService)
    {
        $this->depositService = $depositService;
    }

    public function closeDay(){
       $this->depositService->closeDay();
       $info = SysInfo::query()->first();
       $info->update(["current_day" =>  Carbon::parse($info->current_day)->addDay()]);
    }
    public function closeMonth(){
        $currentDay = Carbon::parse(SysInfo::query()->first()->current_day);
        $lastDayOfMonth = $currentDay->copy()->addMonth();
        while ($currentDay->lte($lastDayOfMonth)) {
            $info = SysInfo::query()->first();
            $this->depositService->closeDay();
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
            $currentDay->addDay();
            $info->update([
                "current_day" =>  Carbon::parse($info->current_day)->addDay()
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DepositPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deposit_plans')->insert([
            [
                "name" => "Альфа сливки",
                "percent" => 18,
                "period_in_days" => 547,
                "revocable" => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Альфа-вклад (отзывной)",
                "percent" => 9,
                "period_in_days" => 367,
                "revocable" => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Альфа-сейф",
                "percent" => 6,
                "period_in_days" => 182,
                "revocable" => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Альфа-Гранд",
                "percent" => 12.5,
                "period_in_days" => 243,
                "revocable" => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}

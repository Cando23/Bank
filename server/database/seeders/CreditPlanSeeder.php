<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CreditPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credit_plans')->insert([
            [
                "name" => "Decent on a personal level",
                "percent" => 18,
                "min_amount" => 1000,
                "max_amount" => 5000,
                "min_period" => 12,
                "max_period" => 36,
                "annuity" => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "As easy as pie",
                "percent" => 16.5,
                "min_amount" => 500,
                "max_amount" => 2000,
                "min_period" => 6,
                "max_period" => 12,
                "annuity" => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "name" => "Online credit match",
                "percent" => 17,
                "min_amount" => 100,
                "max_amount" => 4000,
                "min_period" => 12,
                "max_period" => 12,
                "annuity" => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}

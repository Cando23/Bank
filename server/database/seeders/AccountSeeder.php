<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert(
            [
                [
                    "number" => "1010000000000",
                    "debit" => 0,
                    "credit" => 0,
                    "balance" => 0,
                    "plan_id" => 3,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "number" => "7327000000000",
                    "debit" => 0,
                    "credit" => 100000,
                    "balance" => 0,
                    "plan_id" => 4,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]
            ]
        );
    }
}

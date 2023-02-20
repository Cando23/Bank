<?php

namespace Database\Seeders;

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
                    "plan_id" => 3
                ],
                [
                    "number" => "7327000000000",
                    "debit" => 100000,
                    "credit" => 0,
                    "balance" => 0,
                    "plan_id" => 4
                ]
            ]
        );
    }
}

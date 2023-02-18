<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AccountPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_plans')->insert([
            [
                'number' => '3014',
                'name' => 'Passive account of individuals',
                'type' => 'P',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'number' => '2014',
                'name' => 'Active account of individuals',
                'type' => 'A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'number' => '1010',
                'name' => 'Bank cash desk',
                'type' => 'A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'number' => '7327',
                'name' => 'Bank Development Fund',
                'type' => 'P',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

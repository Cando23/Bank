<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\SysInfo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([CitizenshipSeeder::class,
            DisabilitySeeder::class,
            MaritalStatusSeeder::class,
            AccountPlanSeeder::class,
            AccountSeeder::class,
            DepositPlanSeeder::class,
            CreditPlanSeeder::class]);
        SysInfo::factory(1)->create();
        City::factory(10)->create();
        User::factory(10)->create();
    }
}

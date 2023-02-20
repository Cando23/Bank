<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Citizenship;
use App\Models\City;
use App\Models\Disability;
use App\Models\MaritalStatus;
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
            DepositPlanSeeder::class]);
        City::factory(10)->create();
        User::factory(10)->create();
    }
}

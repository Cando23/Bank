<?php

namespace Database\Factories;

use App\Models\Citizenship;
use App\Models\City;
use App\Models\Disability;
use App\Models\MaritalStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'patronymic' => fake()->firstName('male'),
            'date_of_birth' => fake()->date(),
            'gender' => Arr::random(['M', 'F']),
            'passport_series' => Arr::random(['AB', 'BM', 'HB', 'KH', 'MP', 'MC', 'KB', 'PP', 'SP', 'DP']),
            'passport_number' => fake()->numerify("#######"),
            'passport_id_number' => fake()->numerify('#######' . Arr::random(['A', 'B', 'C', 'H', 'K', 'E', 'M']) . "###" . Arr::random(['PB', 'BA', 'BI']) . "#"),
            'passport_issued_by' => fake()->company(),
            'passport_issue_date' => fake()->date(),
            'place_of_birth' => 'REPUBLIC OF BELARUS',
            'email' => fake()->safeEmail(),
            'personal_phone' => fake()->numerify('+375' . Arr::random(['44', '29', '25', '33']) . "#######"),
            'home_phone' => fake()->numerify('8029#######'),
            'residence_address' => fake()->streetAddress(),
            'pensioner' => fake()->boolean(),
            'residence_city_id' => City::query()->inRandomOrder()->first()->id,
            'registration_city_id' => City::query()->inRandomOrder()->first()->id,
            'marital_status_id' => MaritalStatus::query()->inRandomOrder()->first()->id,
            'citizenship_id' => Citizenship::query()->inRandomOrder()->first()->id,
            'disability_id' => Disability::query()->inRandomOrder()->first()->id,
            'income' => fake()->randomFloat(2, 200, 10000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}

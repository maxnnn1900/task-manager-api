<?php

namespace Database\Factories;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->randomElement([
                EmployeeStatus::Working->value,
                EmployeeStatus::Vacation->value,
            ]),
        ];
    }
}

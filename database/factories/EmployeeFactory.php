<?php

namespace Database\Factories;

use Faker\Guesser\Name;
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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->unique()->jobTitle(),
            'dob' => fake()->unique()->date(),
            'address' => fake()->unique()->address(),
            'phone' => fake()->unique()->e164PhoneNumber(),

        ];
    }
}

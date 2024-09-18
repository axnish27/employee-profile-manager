<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beneficiary_name' => fake()->name(),
            'account_no' => fake()->unique()->numberBetween(834560000, 894560000),
            'bank_name' => fake()->streetSuffix(),
            'branch' => fake()->city(),
            'employee_id' => fake()->unique()->numberBetween(1,200),
        ];
    }
}

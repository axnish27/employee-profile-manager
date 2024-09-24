<?php

namespace Database\Factories;
use App\Models\Employee;
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
            'employee_id' => Employee::factory(),
            'beneficiary_name' => function (array $attributes) {
                return Employee::find($attributes['employee_id'])->name;},
            'account_no' => fake()->unique()->numberBetween(834560000, 894560000),
            'bank_name' => fake()->streetSuffix(),
            'branch' => fake()->city(),


        ];
    }
}

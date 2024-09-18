<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Models\BankAccount;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(20)->create();
        Employee::factory(200)->create();
        BankAccount::factory(200)->create();
        Project::factory(60)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' =>  Hash::make('password')
        ]);

        for ($i=0; $i < 1000 ; $i++) {
            DB::table('project_employee')->insert([
                'project_id' => fake()->numberBetween(1,60),
                'employee_id' => fake()->numberBetween(1,200)
            ]);
        }
    }
}

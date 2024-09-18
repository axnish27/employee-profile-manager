<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(10)->create();
        Employee::factory(100)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' =>  Hash::make('password')
        ]);

    }
}

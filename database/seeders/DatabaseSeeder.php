<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::create([
            'name' => '
        ]);

        User::factory()->create([
            'name' => 'irvanfebri',
            'email' => 'hrd@anshal.com',
            'password' => bcrypt('123456'),
            'company_id' =>1,
            'role' => 'employee',
            'department' => 'IT',
            'photo' => null,
            'status' => 'Active',
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@anshal.com',
            'password' => bcrypt('123456'),
            'company_id' =>1,
            'role' => 'employee',
            'department' => 'HR',
            'photo' => null,
            'status' => 'Active',
        ]);


    }
}

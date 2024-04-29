<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
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
            'company_name' => 'Alpawave inc',
            'description' => 'Leading technology solution provider for',
            'photo' => null,
            'address' => '123 main street', 
            'latitude' => 40.7128, 
            'longitude' => 4.0060, 
            'working_hour_start'=>'08.00', 
            'working_hour_end'=>'17.00', 
            'status'=>'Active', 
        ]);

        Company::create([
            'company_name' => 'Innovate Ltd',
            'description' => 'Driving inovatation in various industries',            
            'photo' => null,
            'address' => '456 Elm Street', 
            'latitude' => 34.0522, 
            'longitude' => -118.2437, 
            'working_hour_start'=>'09.00', 
            'working_hour_end'=>'18.00', 
            'status'=>'Active', 
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

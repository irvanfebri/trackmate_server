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
        // Membuat 3 perusahaan
        $companies = [
            [
                'company_name' => 'Alphawave inc',
                'description' => 'Leading technology solution provider for',
                'photo' => null,
                'address' => '123 main street',
                'latitude' => 40.7128,
                'longitude' => 4.0060,
                'working_hour_start'=>'08.00',
                'working_hour_end'=>'17.00',
                'status'=>'Active',
            ],

            [
                'company_name' => 'InnovateHub Ltd',
                'description' => 'Driving inovatation in various industries',
                'photo' => null,
                'address' => '456 Elm Street',
                'latitude' => 34.0522,
                'longitude' => -118.2437,
                'working_hour_start'=>'09.00',
                'working_hour_end'=>'18.00',
                'status'=>'Active',
            ],

        ];

foreach ($companies as $companyData) {
$company = Company::create($companyData);


//membuat 10 pengguna untuk setiap perusahaan
for ($i = 1; $i <=10; $i++) {
    $companyDomain = strtolower(str_replace('','', $company->company_name));
    $companyDomain = strtolower(str_replace('.','', $companyDomain));

    User::create([
        'name' => 'User ' . $i,
        'email' => "user$i.$companyDomain@demo.com",
        'password' => bcrypt('123456'),
        'company_id' =>$company->id,
        'role' => 'Employee',
        'department' => 'IT',
        'photo' => null,
        'status' => 'Active',
    ]);
}

for ($i = 1; $i <=10; $i++) {
    User::create([
        'name' => 'HRD ' . $i,
        'email' => "hrd$i.$companyDomain@demo.com",
        'password' => bcrypt('123456'),
        'company_id' =>$company->id,
        'role' => 'HRD',
        'department' => 'IT',
        'photo' => null,
        'status' => 'Active',
    ]);
}

}}}

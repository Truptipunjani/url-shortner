<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run()
    {

        // Company
        $company = Company::create([
            'name' => 'TCS'
        ]);

        // Admin
        User::create([
            'name' => 'Rahul',
            'email' => 'admin@tcs.com',
            'password' => Hash::make('123456'),
            'role' => 'Admin',
            'company_id' => $company->id
        ]);

        // Member
        User::create([
            'name' => 'Aman',
            'email' => 'member@tcs.com',
            'password' => Hash::make('123456'),
            'role' => 'Member',
            'company_id' => $company->id
        ]);
    }
}

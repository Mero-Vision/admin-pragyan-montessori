<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admindata = [
            'name' => 'Pragyan Montessori',
            'dob' => '2000-02-20',
            'email' => 'support@pragyanmontessori.com',
            'gender' => 'Male',
            'password' => Hash::make('Password'),
            'address' => 'Naikap',
            'mobile_no' => '9840393746',
            'email_verified_at' => Carbon::now(),
            'role' => 'admin',

        ];

        User::firstOrCreate(['email' => $admindata['email']], $admindata);
    }
}
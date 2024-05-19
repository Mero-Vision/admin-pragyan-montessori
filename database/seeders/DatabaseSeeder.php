<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(AdminUserSeeder::class);
       $this->call(ClassTimeTableDaySeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(LatePaymentFinePercentSeeder::class);
    }
}
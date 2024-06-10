<?php

namespace Database\Seeders;

use App\Models\PaymentOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentOption::firstOrCreate([
            'payment_name' => "Cash",
        ], [
            'payment_name' => "Cash",
        ]);
    }
}

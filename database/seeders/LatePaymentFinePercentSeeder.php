<?php

namespace Database\Seeders;

use App\Models\LatePaymentFine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatePaymentFinePercentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $finePercent = ['5'];

        foreach ($finePercent as $finePercent) {
            LatePaymentFine::firstOrCreate(['fine_percent' => $finePercent]);
        }
    }
}
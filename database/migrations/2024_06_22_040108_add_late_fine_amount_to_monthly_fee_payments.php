<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('monthly_fee_payments', function (Blueprint $table) {
            $table->float('late_fine_amount')->nullable()->after('credit_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_fee_payments', function (Blueprint $table) {
            $table->dropColumn('late_fine_amount');
        });
    }
};
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
            $table->string('payment_status')->default('paid')->after('payment_date');
            $table->float('due_amount')->nullable()->after('net_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_fee_payments', function (Blueprint $table) {
            $table->dropColumn('payment_status');
            $table->dropColumn('due_amount');
        });
    }
};
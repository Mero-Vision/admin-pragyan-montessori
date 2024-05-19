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
        Schema::create('monthly_fee_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('net_total')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('nepali_payment_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_fee_payments');
    }
};
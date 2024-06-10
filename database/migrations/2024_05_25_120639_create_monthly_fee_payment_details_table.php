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
        Schema::create('monthly_fee_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_session_id')->nullable();
            $table->foreignId('monthly_fee_payment_id')->nullable();
            $table->string('particulars')->nullable();
            $table->float('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_fee_payment_details');
    }
};
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
        Schema::create('admission_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->string('user')->nullable();
            $table->date('enrollment_date')->nullable();
            $table->string('billing_status')->default('pending');
            $table->foreignId('payment_option_id')->nullable();
            $table->longText('note')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('net_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_payments');
    }
};
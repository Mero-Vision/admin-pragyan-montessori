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
        Schema::create('monthly_fees_particulars', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->string('particulars')->nullable();
            $table->float('amount')->nullable();
            $table->float('order_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_fees_particulars');
    }
};
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
        Schema::create('bank_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->nullable();
            $table->string('user')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->decimal('amount', 18, 2)->nullable();
            $table->decimal('balance', 18, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_books');
    }
};
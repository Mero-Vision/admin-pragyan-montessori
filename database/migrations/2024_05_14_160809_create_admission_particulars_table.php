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
        Schema::create('admission_particulars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_session_id')->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('admission_particulars');
    }
};
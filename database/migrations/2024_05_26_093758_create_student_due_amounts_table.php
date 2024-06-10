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
        Schema::create('student_due_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_session_id')->nullable();
            $table->foreignId('student_id')->nullable();
            $table->float('due_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_due_amounts');
    }
};
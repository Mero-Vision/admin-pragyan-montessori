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
        Schema::create('student_admission_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('child_name')->nullable();
            $table->string('child_dob')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_designation')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('inquiry_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_admission_inquiries');
    }
};
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
        Schema::create('student_subject', function (Blueprint $table) {
            $table->id('students_subject_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('sy_id');
            
            $table->foreign('student_id')->references('id')->on('student')->cascadeOnDelete();
            $table->foreign('subject_id')->references('id')->on('subject')->cascadeOnDelete();
            $table->foreign('sy_id')->references('id')->on('school_yr')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subject');
    }
};
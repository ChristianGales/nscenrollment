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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->time('time_from');
            $table->time('time_to');
            $table->string('day');
            $table->string('room');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('sy_id');

            // Foreign key constraints (corrected!)
            $table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade'); // Added onDelete('cascade')
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade'); // Added onDelete('cascade')
            $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade'); // Added onDelete('cascade')
            $table->foreign('sy_id')->references('id')->on('school_yr')->onDelete('cascade'); // Corrected table name and added onDelete('cascade')

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
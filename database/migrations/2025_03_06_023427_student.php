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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('lrn', 12)->unique();
            $table->unsignedBigInteger('grade_lvl_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            
            // Student Information
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('suffix')->nullable();
            $table->string('gender');
            $table->date('bday');
            $table->string('bplace');
            $table->string('PSA_num');
            $table->string('fb_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            
            // Address
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('bgry');
            $table->string('municipality');
            $table->string('province');
            $table->string('country');
            $table->string('zipcode');
            
            // Family Background
            $table->string('fathername')->nullable();
            $table->string('f_contact')->nullable();
            $table->string('mothername');
            $table->string('m_contact');
            $table->string('guardian');
            $table->string('g_contact');
            
            $table->foreign('section_id')->references('id')->on('section')->nullOnDelete();
            $table->foreign('grade_lvl_id')->references('id')->on('grade_lvl')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
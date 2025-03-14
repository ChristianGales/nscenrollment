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
        Schema::table('section', function (Blueprint $table) {
            //
            $table->dropColumn('student_lmt');
            $table->unsignedBigInteger('grade_lvl_id')->nullable();
            $table->foreign('grade_lvl_id')->references('id')->on('grade_lvl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section', function (Blueprint $table) {
            //
            $table->integer('student_lmt')->nullable();
            $table->dropForeign(['grade_lvl_id']);
            $table->dropColumn('grade_lvl_id');
        });
    }
};

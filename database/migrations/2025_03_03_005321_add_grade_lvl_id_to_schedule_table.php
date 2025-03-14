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
        Schema::table('schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_lvl_id')->nullable()->after('room'); 
            $table->foreign('grade_lvl_id')->references('id')->on('grade_lvl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->dropForeign(['grade_lvl_id']);
            $table->dropColumn('grade_lvl_id');
        });

    }
};

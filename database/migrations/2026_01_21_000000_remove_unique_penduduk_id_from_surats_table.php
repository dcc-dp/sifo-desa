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
        // Drop foreign key dan unique constraint
        Schema::table('surats', function (Blueprint $table) {
            $table->dropForeign(['penduduk_id']);
            $table->dropUnique(['penduduk_id']);
        });

        // Recreate foreign key tanpa unique
        Schema::table('surats', function (Blueprint $table) {
            $table->foreign('penduduk_id')->references('id')->on('data_penduduks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropForeign(['penduduk_id']);
        });

        Schema::table('surats', function (Blueprint $table) {
            $table->unique('penduduk_id');
            $table->foreign('penduduk_id')->references('id')->on('data_penduduks');
        });
    }
};

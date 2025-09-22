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
        Schema::create('s_k_t_m_s', function (Blueprint $table) {
            $table->id();
            // $table->string('surat_id');
            $table->unsignedBigInteger('surat_id')->unique();
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->foreign('surat_id')->references('id')->on('surats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_k_t_m_s');
    }
};

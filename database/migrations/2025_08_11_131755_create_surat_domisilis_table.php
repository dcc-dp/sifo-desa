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
        Schema::create('surat_domisilis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id')->unique();
            $table->foreign('surat_id')->references('id')->on('surats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_domisilis');
    }
};

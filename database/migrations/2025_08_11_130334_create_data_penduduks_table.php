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
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('keldesa');
            $table->string('kecamatan');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            


            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penduduks');
    }
};

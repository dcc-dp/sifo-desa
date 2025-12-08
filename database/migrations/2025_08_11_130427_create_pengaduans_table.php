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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_id');
            $table->string('user_id');
            $table->string('judul');
            $table->string('gambar');
            $table->string('deskripsi');
            $table->string('file');
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('1=proses, 2=tolak, 3=selesai');
            $table->boolean('anonymous');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

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
        // Cek dulu jika tabel sudah ada, tidak usah create lagi
        if (!Schema::hasTable('pengaduans')) {
            Schema::create('pengaduans', function (Blueprint $table) {
                $table->id();

                // Relasi kategori
                $table->foreignId('kategori_id')
                    ->constrained('kategoris')
                    ->cascadeOnDelete();

                // Relasi user (nullable untuk anonymous)
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();

                $table->string('judul');
                $table->text('deskripsi');

                $table->string('gambar')->nullable();
                $table->string('file')->nullable();

                $table->integer('status')->default(1)->comment('1=proses, 2=tolak, 3=selesai');
                $table->boolean('anonymous')->default(false);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

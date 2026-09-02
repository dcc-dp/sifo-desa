<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('logo_surat')->nullable()->after('nomor_surat_berikutnya');
            $table->string('stempel_surat')->nullable()->after('logo_surat');
            $table->string('ttd_kepala_desa')->nullable()->after('stempel_surat');
        });

        // Set default values for existing record so existing letters never break
        DB::table('settings')->update([
            'logo_surat' => 'uploads/galeri/logo_sifo.png',
            'stempel_surat' => 'uploads/galeri/stempel.png',
            'ttd_kepala_desa' => 'uploads/galeri/ttd_kedes.png',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['logo_surat', 'stempel_surat', 'ttd_kepala_desa']);
        });
    }
};

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    
    protected $table = 'surats'; 
    protected $fillable = [
        'penduduk_id',
        'nomor_surat',
        'tanggal_dibuat',
        'status',
        'keterangan',
        'file_pdf',
        'alasan_tolak'
    ];

    public function penduduk()
{
    return $this->belongsTo(
        DataPenduduk::class,
        'penduduk_id'
    );
}

public function usaha()
{
    return $this->hasOne(
        Suraketus::class,
        'surat_id'
    );
}

public function domisili()
{
    return $this->hasOne(
        SuratDomisili::class,
        'surat_id'
    );
}

public function izin()
{
    return $this->hasOne(
        SuratIzin::class,
        'surat_id'
    );
}

public function pengantar()
{
    return $this->hasOne(
        SuratPengantar::class,
        'surat_id'
    );
}
public function sktm()
{
    return $this->hasOne(SKTM::class, 'surat_id');
}

    /**
     * Konversi bulan angka (1-12) ke angka Romawi
     */
    public static function getRomawiBulan($month = null): string
    {
        $month = $month ? (int) $month : (int) date('n');
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        return $map[$month] ?? 'I';
    }

    /**
     * Helper membuat string nomor surat berformat: (NOMOR URUT)/(KODE)/(ROMAWI)/(TAHUN)
     */
    public static function formatNomorSurat($nomorUrut, $kodeSurat, $date = null): string
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();
        $pad = is_numeric($nomorUrut) ? sprintf('%03d', (int) $nomorUrut) : $nomorUrut;
        $romawi = self::getRomawiBulan($date->month);
        $tahun = $date->year;

        return "{$pad}/{$kodeSurat}/{$romawi}/{$tahun}";
    }

    /**
     * Mendapatkan kode surat berdasarkan jenis surat:
     * SKU: Surat Keterangan Usaha
     * SKTM: Surat Keterangan Tidak Mampu
     * SKD: Surat Keterangan Domisili
     * SKP: Surat Pengantar
     * SKIK: Surat Keterangan Izin Keramaian
     */
    public function getKodeSuratAttribute(): string
    {
        $ket = strtolower($this->keterangan ?? '');
        if (str_contains($ket, 'usaha')) return 'SKU';
        if (str_contains($ket, 'tidak mampu') || str_contains($ket, 'sktm')) return 'SKTM';
        if (str_contains($ket, 'domisili')) return 'SKD';
        if (str_contains($ket, 'pengantar')) return 'SKP';
        if (str_contains($ket, 'izin') || str_contains($ket, 'keramaian') || str_contains($ket, 'acara')) return 'SKIK';

        if ($this->relationLoaded('usaha') ? $this->usaha : $this->usaha()->exists()) return 'SKU';
        if ($this->relationLoaded('sktm') ? $this->sktm : $this->sktm()->exists()) return 'SKTM';
        if ($this->relationLoaded('domisili') ? $this->domisili : $this->domisili()->exists()) return 'SKD';
        if ($this->relationLoaded('pengantar') ? $this->pengantar : $this->pengantar()->exists()) return 'SKP';
        if ($this->relationLoaded('izin') ? $this->izin : $this->izin()->exists()) return 'SKIK';

        return 'SKU';
    }

    /**
     * Accessor nomor surat agar selalu dalam format (NOMOR URUT)/(KODE)/(ROMAWI)/(TAHUN)
     */
    public function getNomorSuratAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        if (str_contains($value, '/')) {
            return $value;
        }

        $date = $this->tanggal_dibuat ? Carbon::parse($this->tanggal_dibuat) : ($this->created_at ?? Carbon::now());
        return self::formatNomorSurat($value, $this->kode_surat, $date);
    }
}
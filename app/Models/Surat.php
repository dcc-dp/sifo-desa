<?php

namespace App\Models;

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
    ];

    public function penduduk()
{
    return $this->belongsTo(
        dataPenduduk::class,
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

}
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
    ];

    public function penduduk()
{
    return $this->belongsTo(
        dataPenduduk::class,
        'penduduk_id'
    );
}
}
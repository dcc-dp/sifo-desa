<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surats'; 
    protected $fillable = [
        'penduduk_id',
        'jenis_surat_id',
        'nomor_surat',
        'tanggal_dibuat',
        'status',
        'keterangan',
    ];
}

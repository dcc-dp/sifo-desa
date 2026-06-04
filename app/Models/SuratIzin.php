<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    use HasFactory;
    protected $table = 'surat_izins'; 
    protected $fillable = [
        'surat_id',
        'hari',
        'tanggal',
        'tempat',
        'jenis_acara',
        'jumlah_peserta',
    ];

        public function surat()
    {
        return $this->belongsTo(
            Surat::class,
            'surat_id'
        );
    }
}

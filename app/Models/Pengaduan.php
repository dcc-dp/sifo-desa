<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduans'; 
    protected $fillable = [
        'kategori_id',
        'user_id',
        'judul',
        'gambar',
        'deskripsi',
        'file',
        'status',
        'anonymous',
    ];

    protected $casts = [
        'anonymous' => 'boolean',
        'status' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}

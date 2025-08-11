<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

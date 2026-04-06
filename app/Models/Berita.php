<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas'; 
    protected $fillable = [
        'id_kategori',
        'judul',
        'deskripsi',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}

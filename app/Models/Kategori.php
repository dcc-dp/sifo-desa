<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris'; 
    protected $fillable = [
        'nama_kategori',
    ];

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori');
    }

    public function Pengaduans()
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galeris'; 
    protected $fillable = [
        'id_batch',
        'judul',
        'gambar',
    ];
        
    public function batchGaleri()
    {
        return $this->belongsTo(BatchGaleri::class, 'id_batch');
    }
}

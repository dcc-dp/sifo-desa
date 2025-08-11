<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suraketus extends Model
{
    use HasFactory;
    protected $table = 'suraketuses'; 
    protected $fillable = [
        'surat_id',
        'nama_usaha',
        'alamat_usaha',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataPenduduk extends Model
{
    use HasFactory;
    protected $table = 'data_penduduks'; 
    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'keldesa',
        'kecamatan',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
    ];
}

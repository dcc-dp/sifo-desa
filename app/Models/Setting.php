<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_desa',
        'deskripsi',
        'alamat',
        'email',
        'telepon',
        'maps_embed',
        'facebook',
        'instagram',
        'twitter'
    ];
}

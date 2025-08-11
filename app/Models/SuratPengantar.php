<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;
    protected $table = 'surat_pengantars'; 
    protected $fillable = [
        'surat_id',
        'keperluan',
    ];
}

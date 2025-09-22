<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agendas'; 
    protected $fillable = [
        'nama_kegiatan',
        'waktu_pelaksanaan',
    ];
}

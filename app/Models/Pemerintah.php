<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Pemerintah extends Model
{
    use HasFactory;

    protected $table = 'pemerintahs';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';
    protected $fillable = [
        'nomor_rw',
    ];

    public function rts()
    {
        return $this->hasMany(Rt::class);
    }
}

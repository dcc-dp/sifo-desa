<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $fillable = [
        'rw_id',
        'nomor_rt',
    ];

    public function rws()
    {
        return $this->belongsTo(Rw::class);
    }
}

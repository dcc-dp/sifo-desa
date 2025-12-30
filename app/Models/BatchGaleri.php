<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchGaleri extends Model
{
    use HasFactory;

    protected $table = 'batch_galeris';

    protected $fillable = [
        'nama',
    ];

    protected $withCount = ['galeris'];

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'id_batch');
    }

}

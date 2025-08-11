<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchGaleri extends Model
{
    use HasFactory;
    protected $table = 'batch_galeris'; 
    protected $fillable = [
        'nama',
    ];
}

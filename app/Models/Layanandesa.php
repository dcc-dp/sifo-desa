<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanandesa extends Model
{
    use HasFactory;
    protected $table = 'layanandesas'; 
    protected $fillable = [
        'user_id',
    ];
}

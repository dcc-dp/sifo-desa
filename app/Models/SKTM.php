<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SKTM extends Model
{
    use HasFactory;
    protected $table = 's_k_t_m_s'; 
    protected $fillable = [
        'surat_id',
        'pekerjaan',
        'penghasilan',
    ];
}

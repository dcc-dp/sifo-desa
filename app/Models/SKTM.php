<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKTM extends Model
{
    use HasFactory;
    protected $table = 's_k_t_m_s'; 
    protected $fillable = [
        'surat_id',
        'pekerjaan',
        'penghasilan',
    ];

    public function surat(){
        return $this->hasOne(Surat::class, 'id','surat_id');
    }
}

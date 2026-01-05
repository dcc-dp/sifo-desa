<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    use HasFactory;
    protected $table = 'surat_domisilis'; 
    protected $fillable = [
        'surat_id',
    ];

    public function surat(){
        return $this->hasOne(Surat::class, 'id','surat_id');
    }
}
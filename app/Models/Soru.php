<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soru extends Model
{
    use HasFactory;
    protected $table = 'sorular';
    protected $fillable = [
        'soru',
        'quiz_id',
        'cevap1',
        'cevap2',
        'cevap3',
        'cevap4',
        'dogru_cevap',
        'resim'
    ];
}

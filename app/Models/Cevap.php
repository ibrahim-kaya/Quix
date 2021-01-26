<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cevap extends Model
{
    protected $table = 'cevaplar';
    use HasFactory;

    public function Soru()
    {
        return $this->belongsTo('App\Models\Soru');
    }
}

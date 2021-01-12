<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->hasOne('App\Models\User', 'id','olusturan_id');
    }

    public function sorular(){
        return $this->hasMany('App\Models\Soru');
    }
}

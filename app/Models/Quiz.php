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

    public function getUserScore($userid): int
    {
        $sorular = $this->sorular()->get();
        $cevaplar = Cevap::where('userid', $userid)->get();
        $dogru = 0;
        foreach ($sorular as $soru) {
            if ($cevaplar->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap) $dogru++;
        }

        return intval((100 / $sorular->count()) * $dogru);
    }

    public function quizCozdu($userid): int
    {
        $sorular = $this->sorular()->get();
        $cevaplar = Cevap::where('userid', $userid)->get();

        foreach ($sorular as $soru) {
            if ($cevaplar->where('soru_id', $soru->id)->count()) return 1;
        }

        return 0;
    }
}

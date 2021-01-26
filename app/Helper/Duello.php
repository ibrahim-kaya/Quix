<?php


namespace App\Helper;


use Illuminate\Support\Facades\DB;

class Duello
{
    public function GetCozulen($uniqueid, $userid): int
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first();
        return DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', $userid]])
            ->select('a.id')
            ->get()
            ->count();
    }

    public function GetScore($uniqueid, $userid): int
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first();
        return DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', $userid]])
            ->sum('a.puan');
    }

    public function GetDuelloIstekleri($userid): \Illuminate\Support\Collection
    {
        return DB::table('duello')->orderBy('id', 'desc')->where([['rakip_id', $userid], ['kabul', 0]])->get();
    }

    public function GetDevamEdenDuellolar($userid): array
    {
        $duellolar = DB::table('duello as qz')
            ->orderBy('qz.id', 'desc')
            ->where([['qz.olusturan_id', $userid], ['qz.kabul', 1]])
            ->orWhere([['qz.rakip_id', $userid], ['qz.kabul', 1]])
            ->get();

        $res = [];
        foreach($duellolar as $duello)
        {
            if($this->GetCozulen($duello->uniqueid, $duello->olusturan_id) < 10 || $this->GetCozulen($duello->uniqueid, $duello->rakip_id) < 10) array_push($res, $duello);
        }
        return $res;
    }

    public function GetBitenDuellolar($userid): array
    {
        $duellolar = DB::table('duello as qz')
            ->orderBy('qz.id', 'desc')
            ->where([['qz.olusturan_id', $userid], ['qz.kabul', 1]])
            ->orWhere([['qz.rakip_id', $userid], ['qz.kabul', 1]])
            ->get();

        $res = [];
        foreach($duellolar as $duello)
        {
            if($this->GetCozulen($duello->uniqueid, $duello->olusturan_id) >= 10 && $this->GetCozulen($duello->uniqueid, $duello->rakip_id) >= 10) array_push($res, $duello);
        }
        return $res;
    }

    public function GetWinnerID($uniqueid): int
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first();
        $usera = DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', $duello->olusturan_id]])
            ->sum('a.puan');
        $userb = DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', $duello->rakip_id]])
            ->sum('a.puan');

        if($usera >= $userb) return $duello->olusturan_id;
        else return $duello->rakip_id;
    }
}

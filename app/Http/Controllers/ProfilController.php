<?php

namespace App\Http\Controllers;

use App\Models\Cevap;
use App\Models\Kategori;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index($username)
    {
        $id = User::where('name', $username)->get()->first()->id ?? abort(404, 'Kullanıcı bulunamadı!');

        $data = [
            'user' => User::find($id) ?? abort(404, 'Kullanıcı bulunamadı!'),
            'quizler' => Quiz::where([['olusturan_id', $id], ['durum', 1], ['gizlilik', 0]])->get(),
            'kategoriler' => Kategori::all(),
            'cevaplar' => Cevap::where('userid', $id)->get(),
            'cozulenler' => Quiz::join('sorular', 'sorular.quiz_id', '=', 'quizzes.id')->join('cevaplar', 'cevaplar.soru_id', 'sorular.id')->where([['cevaplar.userid', $id], ['quizzes.durum', 1], ['quizzes.gizlilik', 0]])->select('quizzes.*')->groupBy('quizzes.id')->get()
        ];

        return view('quiz.profil.profil')->with('data', $data);
    }
}

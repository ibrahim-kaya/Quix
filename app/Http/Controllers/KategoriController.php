<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth', ['only' => ['TakipEtVeyaBirak']]);
        $this->middleware('PostEditPerm', ['only' => ['edit']]);
    }

    public function show($kategori)
    {
        if (Auth::check()) $uid = Auth::user()->id;
        else $uid = 'u' . Session::getId();

        $data = array(
            'quizzes' => Quiz::where('kategori', $kategori)->where([['durum', '1'],['gizlilik', 0]])->orderBy('id', 'desc')->paginate(12),
            'kategoriler' => Kategori::all(),
            'uid' => $uid,
            'takip' => DB::table('kategori_takip')->where([['userid', $uid], ['kategori', $kategori]])->get()->count(),
            'kategori' => Kategori::where('link', $kategori)->get()->first() ?? abort(404, 'Kategori bulunamadı!')
        );

        return view('quiz.listele')->with('data', $data);
    }

    public function TakipEtVeyaBirak($kategori)
    {
        $durum = DB::table('kategori_takip')->where([['userid', Auth::user()->id], ['kategori', $kategori]])->get()->count();
        if ($durum) {
            DB::table('kategori_takip')->where([['userid', Auth::user()->id], ['kategori', $kategori]])->delete();
            return Redirect::route('kategori', $kategori)->withError('Kategori takipten çıkarıldı!');
        } else {
            DB::table('kategori_takip')->insert(['userid'=>Auth::user()->id, 'kategori'=>$kategori]);
            return Redirect::route('kategori', $kategori)->withSuccess('Kategori takip edildi!');
        }

    }
}

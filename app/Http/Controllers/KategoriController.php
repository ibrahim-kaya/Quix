<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Quiz;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function show($kategori)
    {
        $data = array(
            'quizzes' => Quiz::where('kategori', $kategori)->orderBy('id', 'desc')->paginate(12),
            'kategoriler' => Kategori::all(),
            'kategori' => Kategori::where('link', $kategori)->get()->first() ?? abort(404, 'Kategori bulunamadı!')
        );

        return view('quiz.listele')->with('data', $data);
    }
}

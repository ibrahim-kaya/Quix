<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Soru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateReq;
use App\Http\Requests\QuizUpdateReq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {

        //$this->middleware('auth');
        $this->middleware('PostEditPerm', ['only' => ['edit']]);
    }


    public function index()
    {
        $data = array(
            'quizzes' => Quiz::orderBy('id', 'desc')->paginate(12),
            'kategoriler' => Kategori::all()
        );

        return view('quiz.listele')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriler = Kategori::all();
        return view('quiz.olustur', compact('kategoriler'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateReq $request)
    {
        if(!Kategori::where('link', $request->kategori)->get()->first()) return Redirect::back()->withErrors(['Kategori bulunamadı!']);

        $quiz = new Quiz();
        $quiz->uniqueid = bin2hex(random_bytes(6));
        $quiz->baslik = $request->baslik;
        $quiz->aciklama = $request->aciklama;
        $quiz->kategori = $request->kategori;
        $quiz->olusturan_id = Auth::user()->id;
        $quiz->save();

        return redirect()->route('sorular.index', $quiz->uniqueid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $id = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $data = [
            'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!')
        ];
        return view('quiz.onizleme')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        $data = [
        'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!'),
        'kategoriler' => Kategori::all()
        ];
        return view('quiz.duzenle')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateReq $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!');
        Quiz::where('id', $id)->update($request->except(['_method', '_token']));
        return redirect()->route('quizlerim.index')->withSuccess('Quiz başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

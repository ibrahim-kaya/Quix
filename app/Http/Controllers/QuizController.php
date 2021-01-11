<?php

namespace App\Http\Controllers;

use App\Models\Soru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateReq;
use App\Http\Requests\QuizUpdateReq;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {

        $this->middleware('auth');
        $this->middleware('PostEditPerm', ['only' => ['edit']]);
    }


    public function index()
    {
        $data = array(
            'quizzes' => Quiz::orderBy('id', 'desc')->paginate(12)
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
        return view('quiz.olustur');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateReq $request)
    {
        /*$quiz = new Quiz();
        $quiz->baslik = $request->baslik;
        $quiz->aciklama = $request->aciklama;
        $quiz->olusturan_id = Auth::user()->id;
        $quiz->save();*/

        return redirect()->route('quizler.index')->withSuccess('Quiz başarıyla oluşturuldu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!');
        return view('quiz.duzenle', compact('quiz'));
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

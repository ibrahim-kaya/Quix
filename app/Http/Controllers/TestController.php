<?php

namespace App\Http\Controllers;

use App\Models\Cevap;
use App\Models\Quiz;
use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{

    public function __construct() {

        $this->middleware('auth', ['except' => ['sonucGoster']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sonuc(Request $request)
    {
        $data = $request->validate([
           'cevaplar.*.cevap' => 'required',
           'cevaplar.*.soru' => 'required',
        ],
            [
            'required' => 'Boş bıraktığın sorular var! Tüm soruları cevaplaman gerek.'
        ]);

        $sorular = Soru::where('quiz_id', $request->__id);

        foreach ($request->cevaplar as $item) {
            $q = Soru::find($item['soru']);
            if($q)
            {
                if($q->quiz_id != $request->__id) return Redirect::back()->withErrors(['Çakal mısın olm sen??']);
            }
            else{
                return Redirect::back()->withErrors(['Çakal mısın olm sen??']);
            }
        }

        foreach ($request->cevaplar as $item) {

            //--[ Eğer önceden çözülmüşse direk sonuç sayfasına atar ]--

            if(Cevap::where([['soru_id', $item['soru']], ['userid', Auth::user()->id]])->first()) return Redirect::route('sonuc_Goster', [Auth::user()->id, $request->__id]);

            /*--[ Eğer önceden çözülmüşse eski cevapları yenileriyle değiştirir ]--

            $cevap = Cevap::where([['soru_id', $item['soru']], ['userid', Auth::user()->id]])->first();
            if(!$cevap)*/ $cevap = new Cevap();
            $cevap->userid = Auth::user()->id;
            $cevap->soru_id = $item['soru'];
            $cevap->cevap = $item['cevap'];
            $cevap->save();
        }

        return Redirect::route('sonuc_Goster', [Auth::user()->id, $request->_id]);
    }

    public function sonucGoster($id, $quizid)
    {
        $quizid = Quiz::where('uniqueid', $quizid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $data = [
            'userid' => $id,
            'quiz' => Quiz::find($quizid) ?? abort(404, 'Quiz bulunamadı!'),
            'sorular' => Quiz::find($quizid)->sorular,
            'cevaplar' => Cevap::where('userid', $id)->get()
        ];

        if(!$data['cevaplar']->where('soru_id', $data['sorular']->first()->id)->count()) return Redirect::route('quizler.index')->withErrors('Sonuç bulunamadı!');

        return view('quiz.sonuc')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        if(Cevap::where('userid', Auth::user()->id)->get()->where('soru_id', Quiz::find($id)->sorular->first()->id)->count()){
            return Redirect::route('sonuc_Goster', [Auth::user()->id, $id]);
        }

        $data = [
            'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!'),
            'sorular' => Quiz::find($id)->sorular
        ];
        return view('quiz.quiz')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

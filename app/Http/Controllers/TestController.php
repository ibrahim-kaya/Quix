<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{
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

        $dogru = 0;

        foreach ($request->cevaplar as $item) {
            $q = Soru::find($item['soru']);
            if($q)
            {
                if($q->quiz_id == $request->__id)
                {
                    if($q->dogru_cevap == $item['cevap']) $dogru++;
                }
                else return Redirect::back()->withErrors(['Çakal mısın olm sen??']);

            }
            else{
                return Redirect::back()->withErrors(['Çakal mısın olm sen??']);
            }
        }

        return $dogru.' / '.count($request->cevaplar);

        //return $soru->soru;
    }

    public function sonucGoster($id, $quizid)
    {

        return $id.'-'.$quizid;
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
        $data = [
            'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!'),
            'sorular' => Soru::where('quiz_id', $id)->get()
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

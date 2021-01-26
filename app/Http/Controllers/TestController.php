<?php

namespace App\Http\Controllers;

use App\Models\Cevap;
use App\Models\Puan;
use App\Models\Quiz;
use App\Models\Soru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{

    /*public function __construct() {

        $this->middleware('auth', ['except' => ['sonucGoster']]);
    }*/


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

        if(!Auth::check()){
            if(is_null($request->isim)) return Redirect::route('quizler.show', $request->_id)->withErrors(['İsmini göremedik. Tekrar dene.']);
        }

        $sorular = Soru::where('quiz_id', $request->__id);

        foreach ($request->cevaplar as $item) {
            $q = Soru::find($item['soru']);
            if($q)
            {
                if($q->quiz_id != $request->__id) return Redirect::back()->withErrors(['Bazı uyuşmazlıklar söz konusu! Tekrar dene.']);
            }
            else{
                return Redirect::back()->withErrors(['Bazı uyuşmazlıklar söz konusu! Tekrar dene.']);
            }
        }

        if(Auth::check()) $uid = Auth::user()->id;
        else $uid = 'u'.Session::getId();


        foreach ($request->cevaplar as $item) {

            //--[ Eğer önceden çözülmüşse direk sonuç sayfasına atar ]--

            if(Cevap::where([['soru_id', $item['soru']], ['userid', $uid]])->first()) return Redirect::route('sonuc_Goster', [Auth::user()->id, $request->_id]);

            /*--[ Eğer önceden çözülmüşse eski cevapları yenileriyle değiştirir ]--

            $cevap = Cevap::where([['soru_id', $item['soru']], ['userid', Auth::user()->id]])->first();
            if(!$cevap)*/ $cevap = new Cevap();
            $cevap->userid = $uid;
            $cevap->soru_id = $item['soru'];
            $cevap->cevap = $item['cevap'];
            if(isset($request->isim)) $cevap->isim = $request->isim;
            $cevap->save();
        }

        return Redirect::route('sonuc_Goster', [$uid, $request->_id]);
    }

    public function sonucGoster($id, $quizid)
    {
        $quizid = Quiz::where('uniqueid', $quizid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $data = [
            'userid' => $id,
            'quiz' => Quiz::find($quizid) ?? abort(404, 'Quiz bulunamadı!'),
            'sorular' => Quiz::find($quizid)->sorular,
            'cevaplar' => Cevap::where('userid', $id)->get(),
            'puan' => Puan::where([['userid', $id], ['quizid', $quizid]])->get(),
            'ortpuan' => Puan::avg('puan')
        ];

        $usr = [];
        if(!is_numeric($id))
        {
            $usr['id'] = $id;
            $usr['name'] = $data['cevaplar']->first()->isim;
            $usr['profile_photo_url'] = 'https://ui-avatars.com/api/?name='.$data['cevaplar']->first()->isim.'&color=7F9CF5&background=EBF4FF';
            $arr = ['user' => (object) $usr];
            $res = array_merge($data, $arr);
        }
        else
        {
            $arr = ['user' => User::find($id)];
            $res = array_merge($data, $arr);
        }

        if(!$data['cevaplar']->where('soru_id', $data['sorular']->first()->id)->count()) return Redirect::route('quizler.index')->withErrors('Sonuç bulunamadı!');

        return view('quiz.sonuc')->with('data', $res);
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
    public function show(Request $request, $uniqueid)
    {
        if(!Auth::check())
        {
            $validated = $request->validate([
                'isim' => 'required',
            ], [], [
                'isim' => 'İsim',
            ]);
        }

        $id = Quiz::where('uniqueid', $uniqueid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        if(Auth::check()) $uid = Auth::user()->id;
        else $uid = 'u'.Session::getId();

        if(Cevap::where('userid', $uid)->get()->where('soru_id', Quiz::find($id)->sorular->first()->id)->count()){
            return Redirect::route('sonuc_Goster', [$uid, $uniqueid]);
        }

        $data = [
            'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!'),
            'sorular' => Quiz::find($id)->sorular,
            'isim' => $request->isim
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

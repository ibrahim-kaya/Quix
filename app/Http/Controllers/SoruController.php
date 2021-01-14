<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class SoruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        $quiz = Quiz::whereId($id)->with('sorular')->first();
        return view('quiz.construct.sorular', compact('quiz'));
    }

    public function soruSil($uniqueid, $soruid)
    {
        return $uniqueid.' - '.$soruid;
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
    public function store(Request $request, $uniqueid)
    {
        $validated = $request->validate([
            'soru' => 'required|max:250',
            'resim' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
            'cevap1' => 'required|max:250',
            'cevap2' => 'required|max:250',
            'cevap3' => 'required|max:250',
            'cevap4' => 'required|max:250',
            'dogru_cevap' => 'required|in:cevap1,cevap2,cevap3,cevap4',
        ], [], [
            'soru' => 'Soru',
            'resim' => 'Soru resmi',
            'cevap1' => 'A şıkkı',
            'cevap2' => 'B şıkkı',
            'cevap3' => 'C şıkkı',
            'cevap4' => 'D şıkkı',
            'dogru_cevap' => 'Doğru cevap',
        ]);

        $id = Quiz::where('uniqueid', $uniqueid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $request->merge(['quiz_id'=>$id]);

        if($request->hasFile('resim')){
            $fileName = bin2hex(random_bytes(6)).'.'.$request->resim->getClientOriginalextension();
            $fileDir = '/uploads/'.$fileName;
            $request->resim->move(public_path('uploads'), $fileName);
            $request->merge(['resim'=>$fileDir]);
        }
        Quiz::find($id)->sorular()->create($request->post());
        return redirect()->route('sorular.index', $uniqueid)->withSuccess('Soru başarıyla eklendi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

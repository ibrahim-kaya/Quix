<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Quiz;
use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class SoruController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        if(Auth::user()->type != "admin" && Quiz::find($id)->getUser->id != Auth::user()->id) return redirect()->route('quizlerim.index')->withErrors('Bu Quiz\'i sen oluşturmamışsın!');
        if(Auth::user()->type != "admin" && Quiz::find($id)->durum) return redirect()->back()->withErrors('Bu Quiz yayınlanmış! Yayınlanmış Quiz\'lerin soruları değiştirilemez.');
        $quiz = Quiz::whereId($id)->with('sorular')->first();
        $kategori = Kategori::where('link', $quiz->kategori)->get()->first();
        return view('quiz.construct.sorular', compact('quiz', 'kategori'));
    }

    public function soruSil($uniqueid, $soruid)
    {
        $id = Quiz::where('uniqueid', $uniqueid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        if(Auth::user()->type != "admin" && Quiz::find($id)->getUser->id != Auth::user()->id) return redirect()->route('sorular.index', $uniqueid)->withErrors('Bu Quiz\'i sen oluşturmamışsın!');
        if(Auth::user()->type != "admin" && Quiz::find($id)->durum) return redirect()->back()->withErrors('Bu Quiz yayınlanmış! Yayınlanmış Quiz\'lerin soruları değiştirilemez.');
        if(Soru::find($soruid)->quiz_id != $id) return redirect()->route('sorular.index', $uniqueid)->withErrors('Bazı uyuşmazlıklar söz konusu. Tekrar denemeyi dene.');
        Soru::destroy($soruid);
        return redirect()->route('sorular.index', $uniqueid)->withSuccess('Sildik gitti!');
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
            'soru' => 'required|max:500',
            'resim' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
            'cevap1' => 'required|max:250',
            'cevap2' => 'required|max:250',
            'cevap3' => 'nullable|max:250',
            'cevap4' => 'nullable|max:250',
            'dogru_cevap' => 'required|in:cevap1,cevap2,cevap3,cevap4',
        ], [], [
            'soru' => 'Soru',
            'resim' => 'Soru resmi',
            'cevap1' => 'A şıkkı',
            'cevap2' => 'B şıkkı',
            'cevap3' => 'C şıkkı',
            'cevap4' => 'D şıkkı',
            'dogru_cevap' => 'Doğru Cevap'
        ]);

        if((is_null($request->cevap3) && $request->dogru_cevap === "cevap3") || (is_null($request->cevap4) && $request->dogru_cevap === "cevap4")) return redirect()->back()->withErrors(['Geçerli bir doğru cevap seçmedin!', 'dogru_cevap']);

        $id = Quiz::where('uniqueid', $uniqueid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $request->merge(['quiz_id'=>$id]);

        if($request->hasFile('resim')){
            $fileName = bin2hex(random_bytes(6)).'.'.$request->resim->getClientOriginalextension();
            $fileDir = '/uploads/'.$fileName;
            $request->resim->move(public_path('uploads').'/tmp', $fileName);

            $width = 400; // your max width
            $height = 256; // your max height
            $img = Image::make(public_path('uploads').'/tmp/'.$fileName);
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('uploads').'/'.$fileName);
            File::delete(public_path('uploads').'/tmp/'.$fileName);
            $request->merge(['resim'=>$fileDir]);
        }
        Quiz::find($id)->sorular()->create($request->post());
        return redirect()->route('sorular.index', $uniqueid)->withSuccess('Soru başarıyla eklendi!');
    }

    public function soruGuncelle(Request $request, $quizid, $soruid)
    {
        $validated = $request->validate([
            'esoru' => 'required|max:500',
            'resim' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
            'ecevap1' => 'required|max:250',
            'ecevap2' => 'required|max:250',
            'ecevap3' => 'nullable|max:250',
            'ecevap4' => 'nullable|max:250',
            'dogru_cevap' => 'required|in:cevap1,cevap2,cevap3,cevap4',
        ], [], [
            'esoru' => 'Soru',
            'resim' => 'Soru resmi',
            'ecevap1' => 'A şıkkı',
            'ecevap2' => 'B şıkkı',
            'ecevap3' => 'C şıkkı',
            'ecevap4' => 'D şıkkı',
            'dogru_cevap' => 'Doğru cevap'
        ]);

        if((is_null($request->ecevap3) && $request->dogru_cevap === "cevap3") || (is_null($request->ecevap4) && $request->dogru_cevap === "cevap4")) return redirect()->back()->withErrors('Geçerli bir doğru cevap seçmedin!');

        $id = Quiz::where('uniqueid', $quizid)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        if(Quiz::find(Soru::find($soruid)->quiz_id)->getUser->id != Auth::user()->id) return redirect()->back()->withErrors('Bu soru senin Quiz\'ine ait değil!');

        $request->resim = Soru::find($soruid)->resim;

        if($request->hasFile('eresim')){
            $fileName = 'soru_'.$soruid.'.'.$request->eresim->getClientOriginalextension();
            $fileDir = '/uploads/'.$fileName;
            $request->eresim->move(public_path('uploads').'/tmp', $fileName);

            $width = 400; // your max width
            $height = 256; // your max height
            $img = Image::make(public_path('uploads').'/tmp/'.$fileName);
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('uploads').'/'.$fileName);
            File::delete(public_path('uploads').'/tmp/'.$fileName);
            $request->resim = $fileDir;
        }

        Soru::find($soruid)->update([
           'soru' => $request->esoru,
           'cevap1' => $request->ecevap1,
           'cevap2' => $request->ecevap2,
           'cevap3' => $request->ecevap3,
           'cevap4' => $request->ecevap4,
           'dogru_cevap' => $request->dogru_cevap,
           'resim' => $request->resim,
        ]);
        return redirect()->route('sorular.index', $quizid)->withSuccess('Soru başarıyla güncellendi!');
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

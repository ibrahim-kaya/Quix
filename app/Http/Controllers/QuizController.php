<?php

namespace App\Http\Controllers;

use App\Models\Cevap;
use App\Models\Kategori;
use App\Models\Puan;
use App\Models\Soru;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateReq;
use App\Http\Requests\QuizUpdateReq;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth', ['only' => ['create', 'edit']]);
        $this->middleware('PostEditPerm', ['only' => ['edit']]);
    }

    public function anasayfa()
    {
        $data = array(
            'quizzes' => Quiz::whereExists(function ($query) {
                $query->select('*')
                    ->from('kategori_takip')
                    ->where('kategori_takip.userid', Auth::user()->id)
                    ->whereColumn('quizzes.kategori', 'kategori_takip.kategori');
            })
                //->orWhere('quizzes.olusturan_id', Auth::user()->id)
                ->where([['quizzes.durum', 1],['quizzes.gizlilik', 0]])
                ->orderBy('id', 'desc')
                ->get(),
            'kategoriler' => Kategori::all(),
            'uid' => Auth::user()->id
        );

        /*
         'quizler' => Quiz::whereExists(function ($query) {
                $query->select('id')
                    ->from('kategori_takip')
                    ->whereColumn('kategori_takip.userid', Auth::user()->id)->get();
            })
         */


        return view('dashboard')->with('data', $data);
    }


    public function index(Request $req)
    {
        $zaman = 1440;

        if (Auth::check()) $uid = Auth::user()->id;
        else $uid = 'u' . Session::getId();

        $data = array(
            'quizzes' => Quiz::orderBy('id', 'desc')->where([['durum', '1'], ['gizlilik', 0]])->paginate(12),
            'kategoriler' => Kategori::all(),
            'uid' => $uid
        );


        $quizData = [];
        foreach ($data['quizzes'] as $index => $quiz) {
            $quizData[$index]['id'] = $quiz->id;
            $quizData[$index]['score'] = DB::table('cevaplar as a')
                    ->join('sorular as q', 'q.id', '=', 'a.soru_id')
                    ->join('quizzes as qz', 'q.quiz_id', 'qz.id')
                    ->where([['qz.id', $quiz->id], ['a.created_at', '>', Carbon::now()->subMinutes($zaman)]])
                    ->select(['a.userid'])
                    ->groupBy(['a.userid'])
                    ->get()->count()
                +
                Quiz::join('puanlar', 'puanlar.quizid', '=', 'quizzes.id')
                    ->where([['quizzes.id', $quiz->id], ['puanlar.created_at', '>', Carbon::now()->subMinutes($zaman)]])
                    ->sum('puan') * 2;
        };

        $collection = collect($quizData);
        $sorted = $collection->sortByDesc(function ($quiz, $key) {
            return $quiz['score'];
        });

        if (isset($req->d)) {
            if ($req->d === 'son') {
                $sorted = $collection->sortByDesc(function ($quiz, $key) {
                    return $quiz['id'];
                });
            }
        }

        $object = json_decode(json_encode($sorted), FALSE);

        return view('quiz.listele')->with('data', $data)->with('qdata', $object);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateReq $request)
    {
        if (!Kategori::where('link', $request->kategori)->get()->first()) return Redirect::back()->withErrors(['Kategori bulunamadı!']);

        $unique = bin2hex(random_bytes(6));

        if($request->hasFile('gorsel')){
            $fileName = $unique.'.'.$request->gorsel->getClientOriginalextension();
            $fileDir = '/uploads/'.$fileName;
            $request->gorsel->move(public_path('uploads').'/tmp', $fileName);

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

        $quiz = new Quiz();
        $quiz->uniqueid = $unique;
        $quiz->baslik = $request->baslik;
        $quiz->aciklama = $request->aciklama;
        $quiz->kategori = $request->kategori;
        $quiz->gizlilik = $request->gizlilik;
        $quiz->resim = $request->resim;
        $quiz->olusturan_id = Auth::user()->id;
        $quiz->save();

        return redirect()->route('sorular.index', $quiz->uniqueid);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $id = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        if (Auth::check()) $uid = Auth::user()->id;
        else $uid = 'u' . Session::getId();

        $data = [
            'quiz' => Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!'),
            'userid' => $uid,
            'kategori' => Kategori::where('link', Quiz::find($id)->kategori)->get()->first(),
            'cevaplayanlar' => DB::table('users as u')
                ->join('cevaplar as a', 'u.id', '=', 'a.userid')
                ->join('sorular as q', 'q.id', '=', 'a.soru_id')
                ->join('quizzes as qz', 'q.quiz_id', 'qz.id')
                ->where('qz.id', $id)
                ->select(['u.id', 'u.name'])
                ->groupBy(['u.id', 'u.name'])
                ->get(),
            'toplamcozen' => DB::table('cevaplar as a')
                ->join('sorular as q', 'q.id', '=', 'a.soru_id')
                ->join('quizzes as qz', 'q.quiz_id', 'qz.id')
                ->where('qz.id', $id)
                ->select(['a.userid'])
                ->groupBy(['a.userid'])
                ->get()->count(),
            'puan' => Puan::where('quizid', $id)->get()
        ];

        $userData = [];
        foreach ($data['cevaplayanlar'] as $index => $user) {
            $userData[$index]['id'] = $user->id;
            $userData[$index]['name'] = $user->name;
            $userData[$index]['score'] = $data['quiz']->getUserScore($user->id);
        };

        $sorted = Arr::sort($userData, function ($user) {
            return $user['score'];
        });
        $collection = collect($sorted);

        $sorted = $collection->sortByDesc(function ($user, $key) {
            return $user['score'];
        });


        return view('quiz.onizleme')->with('data', $data)->with('sorted', $sorted);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateReq $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz bulunamadı!');

        if($request->hasFile('gorsel')){
            $fileName = $quiz->uniqueid.'.'.$request->gorsel->getClientOriginalextension();
            $fileDir = '/uploads/'.$fileName;
            $request->gorsel->move(public_path('uploads').'/tmp', $fileName);

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

        Quiz::where('id', $id)->update($request->except(['_method', '_token', 'gorsel']));
        return redirect()->route('quizler.edit', $quiz->uniqueid)->withSuccess('Quiz başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function yayinlandi(Request $request)
    {
        $id = Quiz::where('uniqueid', $request->quiz)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        $quiz = Quiz::find($id);
        $quiz->durum = 1;
        $quiz->save();
        return view('quiz.construct.yayinlandi', compact('quiz'));
    }

    public function oyVer(Request $request)
    {
        $id = Quiz::where('uniqueid', $request->_id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');

        $request->validate([
            'puan' => 'required',
        ], [],
            [
                'puan' => 'Puan'
            ]);

        $oy = new Puan();
        $oy->userid = $request->uid;
        $oy->quizid = $id;
        $oy->puan = $request->puan;
        $oy->save();

        return Redirect::route('sonuc_Goster', [$request->uid, $request->_id]);
    }
}

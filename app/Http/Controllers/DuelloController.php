<?php

namespace App\Http\Controllers;

use App\Helper\Duello;
use App\Models\Kategori;
use App\Models\Soru;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class DuelloController extends Controller
{

    public function index(Request $request)
    {
        $duellolar = new Duello();
        $data = [
            'istekler' => $duellolar->GetDuelloIstekleri(Auth::user()->id),
            'kategoriler' => Kategori::all(),
            'devameden' => $duellolar->GetDevamEdenDuellolar(Auth::user()->id),
            'biten' => $duellolar->GetBitenDuellolar(Auth::user()->id),
            'kabulbekleyen' => DB::table('duello as qz')
                ->orderBy('qz.id', 'desc')
                ->where([['qz.olusturan_id', Auth::user()->id], ['qz.kabul', 0]])
                ->get(),
            'reddedilen' => DB::table('duello as qz')
                ->orderBy('qz.id', 'desc')
                ->where([['qz.olusturan_id', Auth::user()->id], ['qz.kabul', 2]])
                ->orWhere([['qz.rakip_id', Auth::user()->id], ['qz.kabul', 2]])
                ->get()
        ];
        if ($request->durum === 'devam-edenler') return view('duello.duellolarim.tamamlanmayan')->with('data', $data);
        else if ($request->durum === 'istekler') return view('duello.duellolarim.istekler')->with('data', $data);
        return view('duello.duellolarim.duellolarim')->with('data', $data);
    }

    public function hazirla()
    {
        $data = [
            'kategoriler' => Kategori::all()
        ];

        return view('duello.olustur')->with('data', $data);
    }

    public function olustur(Request $request)
    {
        $validated = $request->validate([
            'isim' => 'required',
            'kategori' => 'required',
        ], [], [
            'isim' => 'Rakip ismi',
            'kategori' => 'Kategori',
        ]);

        $rakip = User::where('name', $request->isim)->get()->first();
        if (!$rakip) return redirect()->route('duello_olustur')->withErrors('Bu kullanıcı bulunamadı!');

        $data = [
            'sorular' => Soru::join('quizzes as qz', 'sorular.quiz_id', 'qz.id')
                ->where([['qz.kategori', $request->kategori], ['qz.durum', 1]])
                ->select('sorular.id')
                ->inRandomOrder()
                ->limit(10)
                ->get(),
        ];
        if ($data['sorular']->count() < 10) return redirect()->route('duello_olustur')->withErrors('Bu kategoride yeterli soru yok!');

        $duelloid = bin2hex(random_bytes(6));
        $duello = DB::table('duello')->insertGetId([
            'uniqueid' => $duelloid,
            'olusturan_id' => Auth::user()->id,
            'rakip_id' => $rakip->id,
            'kategori' => $request->kategori,
            'expires_at' => Carbon::now()->addDays(3),
        ]);

        $sorular = array();
        foreach ($data['sorular'] as $key => $soru) {
            $sorular[$key]['duello_id'] = $duello;
            $sorular[$key]['soru_id'] = $soru->id;
        }


        DB::table('duello_sorular')->insert($sorular);

        return redirect()->route('duello_onizleme', $duelloid);
    }

    public function onizleme($uniqueid)
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first() ?? abort(404, 'Düello bulunamadı!');
        if ($duello->rakip_id != Auth::user()->id && $duello->olusturan_id != Auth::user()->id) return redirect()->route('anasayfa')->withErrors('Bu düello seninle ilgili değil!');

        $cevapsayi = DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', Auth::user()->id]])
            ->select('a.id')
            ->get()
            ->count();

        if($cevapsayi >= 10) return Redirect::route('duello_sonuc', $duello->uniqueid);

        $data = [
            'user' => User::find($duello->olusturan_id),
            'user2' => User::find($duello->rakip_id),
            'cevapsayi' => $cevapsayi,
            'duello' => $duello,
            'kategori' => Kategori::where('link', $duello->kategori)->get()->first()
        ];

        if($duello->olusturan_id == Auth::user()->id && !$cevapsayi) return view('duello.olusturanonizleme')->with('data', $data);
        if($duello->kabul || ($duello->olusturan_id == Auth::user()->id)) return view('duello.geridonen')->with('data', $data);
        else return view('duello.onizleme')->with('data', $data);
    }

    public function reddet($uniqueid)
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first() ?? abort(404, 'Düello bulunamadı!');
        if ($duello->rakip_id != Auth::user()->id) return redirect()->route('anasayfa')->withErrors('Bu düello isteği sana gönderilmemiş!');
        if ($duello->kabul) return redirect()->route('anasayfa')->withErrors('Bu düello isteği zaten yanıtlanmış!');

        DB::table('duello')->where('uniqueid', $uniqueid)->update(['kabul' => 2]);
        return redirect()->route('anasayfa')->withSuccess('Düello isteğini reddettin!');
    }

    public function testEkrani(Request $req, $uniqueid)
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first() ?? abort(404, 'Düello bulunamadı!');
        if ($duello->rakip_id != Auth::user()->id && $duello->olusturan_id != Auth::user()->id) return redirect()->route('anasayfa')->withErrors('Bu düello seninle ilgili değil!');

        if ($duello->kabul === 2) return redirect()->route('anasayfa')->withErrors('Bu düello isteği reddedilmiş!');
        elseif (!$duello->kabul && $duello->rakip_id == Auth::user()->id) {
            DB::table('duello')->where('uniqueid', $uniqueid)->update(['kabul' => 1]);
        }

        $sorular = DB::table('sorular as a')
            ->join('duello_sorular as q', 'q.soru_id', '=', 'a.id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where('qz.id', $duello->id)
            ->select('q.*')
            ->get();

        $cevapsayi = DB::table('duello_cevaplar as a')
            ->join('users as u', 'u.id', '=', 'a.userid')
            ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
            ->join('duello as qz', 'q.duello_id', 'qz.id')
            ->where([['qz.id', $duello->id], ['a.userid', Auth::user()->id]])
            ->select('a.id')
            ->get()
            ->count();

        $mesaj = '';
        $puan = 0;
        if ($req->cevap) {
            $out = DB::table('duello_cevaplar as a')
                ->join('users as u', 'u.id', '=', 'a.userid')
                ->join('duello_sorular as q', 'q.id', '=', 'a.dsoru_id')
                ->join('duello as qz', 'q.duello_id', 'qz.id')
                ->where([['qz.id', $duello->id], ['a.userid', Auth::user()->id]])
                ->select('a.id', 'a.dsoru_id', 'a.cevap', 'a.created_at')
                ->orderBy('a.id', 'desc')
                ->first();

            $gecensure = Carbon::now()->diffInSeconds($out->created_at);
            if ($gecensure >= 45) {
                $req->cevap = 'bos';
                $mesaj = 'Süren doldu!';
            } else {
                $cvp = DB::table('sorular as a')
                    ->join('duello_sorular as q', 'q.soru_id', '=', 'a.id')
                    ->where('q.id', $out->dsoru_id)
                    ->select('a.dogru_cevap')
                    ->first();
                if ($req->cevap == $cvp->dogru_cevap) {
                    $puan = (45 - $gecensure) + 10;
                    $mesaj = 'Doğru cevap!';
                } else $mesaj = 'Yanlış cevap!';
            }

            if ($out->cevap === 'bos') DB::table('duello_cevaplar')->where([['dsoru_id', $out->dsoru_id], ['userid', Auth::user()->id]])->update(['cevap' => $req->cevap, 'puan' => $puan]);
        }

        if ($cevapsayi >= $sorular->count()) return Redirect::route('duello_sonuc', $duello->uniqueid);

        $q = [];
        $idx = 0;
        foreach ($sorular as $index => $soru) {
            $idx++;
            if ($index == $cevapsayi) {
                $q = $soru;
                break;
            }
        }

        DB::table('duello_cevaplar')->insert([
            'userid' => Auth::user()->id,
            'dsoru_id' => $q->id,
            'cevap' => 'bos',
            'created_at' => Carbon::now(),
            'puan' => 0,
        ]);

        $data = [
            'duello' => $duello,
            'soru' => Soru::find($q->soru_id),
            'soru_user' => User::find(DB::table('quizzes as qz')
                ->join('sorular as q', 'q.quiz_id', '=', 'qz.id')
                ->where('q.id', $q->soru_id)
                ->select('qz.olusturan_id')
                ->first()->olusturan_id),
            'index' => $idx,
            'puan' => $puan,
            'mesaj' => $mesaj
        ];

        return view('duello.test')->with('data', $data);
    }

    public function sonuc($uniqueid)
    {
        $duello = DB::table('duello')->where('uniqueid', $uniqueid)->get()->first() ?? abort(404, 'Düello bulunamadı!');

        $d = new Duello();

        $a_cevapsayi = $d->GetCozulen($duello->uniqueid, $duello->olusturan_id);
        $b_cevapsayi = $d->GetCozulen($duello->uniqueid, $duello->rakip_id);

        if(Auth::user()->id == $duello->olusturan_id && $a_cevapsayi < 10) return Redirect::route('duello_onizleme', $duello->uniqueid);
        elseif(Auth::user()->id == $duello->rakip_id && $b_cevapsayi < 10) return Redirect::route('duello_onizleme', $duello->uniqueid);

        if (!$duello->kabul) $bdurum = 0;
        else {
            if ($b_cevapsayi < 10) $bdurum = 1;
            else $bdurum = 2;
        }

        $a_puan = 0;
        $b_puan = 0;
        if($a_cevapsayi >= 10) $a_puan = $d->GetScore($duello->uniqueid, $duello->olusturan_id);
        if($bdurum == 2) $b_puan = $d->GetScore($duello->uniqueid, $duello->rakip_id);

        $data = [
            'user1' => User::find($duello->olusturan_id),
            'user2' => User::find($duello->rakip_id),
            'u1_durum' => ($a_cevapsayi < 10) ? 1 : 2,
            'u2_durum' => $bdurum,
            'u1_puan' => $a_puan,
            'u2_puan' => $b_puan,
        ];
        return view('duello.sonuc')->with('data', $data);
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('term');

        $result = User::where('name', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }
}

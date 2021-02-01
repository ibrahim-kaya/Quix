<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\Soru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Sorular extends Component
{

    use WithFileUploads;

    public $quiz;
    public $qid = 0;
    public $editquiz;
    public $kategori;
    public $gzlilik = ['Herkese Açık', 'Liste Dışı (Sadece link ile ulaşılabilinir)'];

    protected $rules = [
        'editquiz.soru' => 'required|max:500',
        'editquiz.resim' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
        'editquiz.cevap1' => 'required|max:250',
        'editquiz.cevap2' => 'required|max:250',
        'editquiz.cevap3' => 'max:250',
        'editquiz.cevap4' => 'max:250',
        'editquiz.dogru_cevap' => 'required|in:cevap1,cevap2,cevap3,cevap4',
    ];

    protected $messages = [
        'editquiz.soru' => 'Soru',
        'editquiz.resim' => 'Soru resmi',
        'editquiz.cevap1' => 'A şıkkı',
        'editquiz.cevap2' => 'B şıkkı',
        'editquiz.cevap3' => 'C şıkkı',
        'editquiz.cevap4' => 'D şıkkı',
        'editquiz.dogru_cevap' => 'Doğru cevap',
    ];

    public function openEditModal($soruid)
    {
        if(Auth::user()->type != "admin" && Quiz::find($id)->getUser->id != Auth::user()->id) session()->flash('error', 'Bu Quiz\'i sen oluşturmamışsın!');
        if(Auth::user()->type != "admin" && Quiz::find($id)->durum) session()->flash('error', 'Bu Quiz yayınlanmış! Yayınlanmış Quiz\'lerin soruları değiştirilemez.');
        if(Soru::find($soruid)->quiz_id != $this->quiz->id) session()->flash('error', 'Bazı uyuşmazlıklar söz konusu. Tekrar denemeyi dene.');
        if(session('error')) return redirect()->route('quizlerim.index');
        $this->editquiz = Soru::find($soruid);
        $this->qid = $soruid;
        $this->dispatchBrowserEvent('oEditModal');
    }

    public function mount($quiz, $kategori)
    {
        $this->quiz = $quiz;
        $this->kategori = $kategori;
    }

    public function render()
    {
        return view('livewire.sorular');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Livewire\Component;

class Quizlerim extends Component
{

    public $selectedQuiz;

    public function quizSil($id){
        $this->selectedQuiz = Quiz::where('uniqueid', $id)->get()->first()->id ?? abort(404, 'Quiz bulunamadı!');
        $this->dispatchBrowserEvent('ModalAc');
    }

    public function quiziSil(){
        $quiz = Quiz::find($this->selectedQuiz) ?? session()->flash('error', 'Quiz bulunamadı.');
        if(session('error')) return redirect()->route('quizlerim.index');
        if($quiz->olusturan_id != Auth::user()->id)
        {
            session()->flash('error', 'Bu quizi sen oluşturmamışsın.');
            return redirect()->route('quizlerim.index');
        }

        $quiz->durum = 2;
        $quiz->save();
        session()->flash('success', 'Quiz başarıyla silindi!');
        return redirect()->route('quizlerim.index');
    }

    public function kapat(){
        $this->dispatchBrowserEvent('ModalKapat');
    }

    public function modalAc() {
        $this->dispatchBrowserEvent('ModalAc');
    }

    public function render()
    {
        $data = array(
            'quizzes' => Quiz::where([['olusturan_id', '=', Auth::user()->id], ['durum', '!=', '2']])->orderBy('id', 'desc')->paginate(5),
            'durumtxt'=> array('Taslak', 'Yayında')
        );

        return view('livewire.quizlerim')->with('data', $data);
    }
}

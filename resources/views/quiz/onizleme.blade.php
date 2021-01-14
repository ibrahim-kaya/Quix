<x-app-layout>
    <x-slot name="header">Quiz</x-slot>

    <h1 class="text-xl font-bold">{{ $data['quiz']->baslik }}</h1>
    <h1 class="text-lg">{{ $data['quiz']->aciklama }}</h1>

    @if(Auth::check())
        @if (\App\Models\Cevap::where('userid', Auth::user()->id)->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->count())
            <p>Çözüldüğü
                tarih: {{ \App\Models\Cevap::where('userid', Auth::user()->id)->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->first()->created_at }}</p>

            <a href="{{ route('sonuc_Goster', [Auth::user()->id, $data['quiz']->uniqueid]) }}">
                <button type="submit" class="btn btn--primary w-full lg:w-1/2 font-bold"><i
                        class="fas fa-check-circle"></i> Sonuçları Göster
                </button>
            </a>
        @else
            <a href="{{ route('quiz.show', $data['quiz']->uniqueid) }}">
                <button class="btn btn--primary w-full lg:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Quize
                    Başla
                </button>
            </a>
        @endif
    @else
        <a href="{{ route('login') }}">
        <button class="btn btn--red w-full lg:w-1/2 font-bold"><i class="fas fa-lock"></i> Quizi Çözmek İçin Giriş Yapmalısın
        </button>
        </a>
    @endif


</x-app-layout>

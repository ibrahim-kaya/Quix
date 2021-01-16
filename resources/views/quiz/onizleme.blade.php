<x-app-layout>
    <x-slot name="header">Quiz</x-slot>
    <div class="m-5">
        <h1 class="text-xl font-bold">{{ $data['quiz']->baslik }}</h1>
        <br>
        <h1 class="text-lg">{{ $data['quiz']->aciklama }}</h1>
        <br>

        @if (\App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->count())
            <p>Çözüldüğü
                tarih: {{ \App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->first()->created_at }}</p>

            <a href="{{ route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid]) }}">
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

        @if(!Auth::check())
            <div class="mt-5">
                <p class="text-sm text-gray-600">Üye girişi yapmamışsın. Üye girişi yaparak çözdüğün soruların kaydedilmesini sağlayabilir, kendi
                    Quiz'lerini oluşturabilir, sana özel anasayfanda takip ettiğin konulardaki yeni Quiz'leri görebilirsin!</p>
                <p class="text-sm text-gray-600">Hemen şimdi üye olmak için <a href="{{ route('register') }}" class="text-blue-500">tıkla!</a></p>
            </div>
        @endif
    </div>

</x-app-layout>

<x-app-layout>
    <link rel="stylesheet" href="/css/rate.css">

    <x-slot name="header">Quiz</x-slot>

    <?php setlocale(LC_TIME, 'tr_TR') ?>

    <div class="m-5 flex flex-col lg:flex-row">
        <div class="w-full lg:w-2/3 lg:pr-5 flex flex-col">
        <h1 class="text-xl font-bold">{{ $data['quiz']->baslik }}</h1>
            <p class="text-sm text-gray-600">Kategori: <a href="{{ route('kategori', $data['quiz']->kategori) }}" class="text-blue-500">{{ $data['kategori']->isim }}</a></p>
        <br>
        <h1 class="text-lg mt-5">{!! nl2br(e($data['quiz']->aciklama)) !!}</h1>
        <br>

            <div class="mt-auto"></div>
            <div class="mt-10"></div>
        @if (\App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->count())
            <p class="mb-2 ml-2 text-gray-600 text-sm">Çözüldüğü
                tarih: <b class="cursor-pointer" title="{{ \App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->first()->created_at->formatLocalized('%d %h %Y %H:%M') }}">{{ \App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->first()->created_at->diffForHumans() }}</b></p>

            <a href="{{ route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid]) }}">
                <button type="submit" class="btn btn--primary w-full sm:w-1/2 font-bold"><i
                        class="fas fa-check-circle"></i> Sonuçları Göster
                </button>
            </a>
        @else
            @if(Auth::check())
                <a href="{{ route('quiz.show', $data['quiz']->uniqueid) }}">
                    <button class="btn btn--primary w-full sm:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Quize
                        Başla
                    </button>
                </a>
            @else
                <br>
                <form action="{{ route('quiz.show', $data['quiz']->uniqueid) }}">
                    <label>Adın nedir?:</label><br>
                    <input type="text" name="isim" class="p-1 rounded-md mb-2 border-gray-400 w-full sm:w-1/2"
                           placeholder="Bir isim gir...">
                    <a href="{{ route('login') }}"><p class="text-sm text-blue-500">Veya giriş yap...</p></a><br>
                    @error('isim')
                    <p class="text-red-600">Quiz'e başlamadan önce bir isim girmelisin!</p><br>
                    @enderror

                    <button class="btn btn--primary w-full sm:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Quize
                        Başla
                    </button>
                </form>

                <div class="mt-5">
                    <p class="text-sm text-gray-600">Üye girişi yapmamışsın. Üye girişi yaparak çözdüğün soruların
                        kaydedilmesini sağlayabilir, kendi
                        Quiz'lerini oluşturabilir, sana özel anasayfanda takip ettiğin konulardaki yeni Quiz'leri
                        görebilirsin!</p>
                    <p class="text-sm text-gray-600">Hemen şimdi üye olmak için <a href="{{ route('register') }}"
                                                                                   class="text-blue-500">tıkla!</a></p>
                </div>
            @endif
        @endif
        </div>
    <div class="border-t mt-5 pt-5 lg:mt-0 lg:pt-0 lg:border-t-0 lg:border-l border-gray-300 lg:pl-4">
        <p class="font-bold text-lg"><i class="fas fa-poll"></i> Quiz İstatistikleri</p><br>

        <p>Quizi oluşturan:</p>
        @include('quiz.templates.user-card', ['user' => $data['quiz']->getUser, 'bg' => 'bg-gray-100', 'border' => 'border-gray-300'])
        <br>
        <p>Oluşturma Tarihi:</p>
        <p class="text-sm"><b>{{ $data['quiz']->created_at->formatLocalized('%d %h %Y %H:%M') }}</b></p>
        <br>
        <p>Çözen kişi sayısı: <b>{{ $data['toplamcozen'] }}</b></p>
        <div class="border border-gray-200 rounded-md bg-gray-100 max-h-32 overflow-y-auto py-2 mt-2">
            <p class="text-sm text-gray-600 pl-2">Skor tablosu:</p>

            @foreach($sorted as $user)
                <div class="flex items-center justify-between px-3 py-1 hover:bg-gray-200 transition duration-500">
                <p><a href="{{ route('profil', $user['name']) }}"><img class="inline w-7 h-7 rounded-full"
                                                                     src="{{ \App\Models\User::find($user['id'])->profile_photo_url }}"
                                                                     alt="{{ $user['name'] }}"/> {{ $user['name'] }}</a></p><p class="bg-green-500 text-white rounded-md px-2 ml-5">Puan: {{ $data['quiz']->getUserScore($user['id']) }}</p>
                </div>
            @endforeach
            <p class="text-sm text-gray-600 px-2 mt-5 italic" style="font-size: 11px;">Skor tablosunda yalnızca gizlilik ayarı herkese açık olan üyeler görünür.</p>
        </div>
        <br>
        <p>Puan:</p>
        <div class="flex items-center">
            <div class="Stars " style="--rating: {{ $data['puan']->avg('puan') }};"
                 aria-label="Bu Quiz 5 üzerinden ortalama {{ number_format((float)$data['puan']->avg('puan'), 1, '.', '') }} puan almış.">
            </div> <p class="ml-2">{{ number_format((float)$data['puan']->avg('puan'), 1, '.', '') }}/5</p>
        </div>
        <p class="text-sm text-gray-500">{{ $data['puan']->count() }} kere oylanmış.</p>
    </div>
    </div>
</x-app-layout>

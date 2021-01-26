<x-app-layout>
    <link rel="stylesheet" href="/css/profil.css">

    <x-slot name="header">Profil</x-slot>

    <div>
        <div class="p-5">
            <div class="flex items-center border-b border-gray-200 pb-5">
                <img class="inline w-16 h-16 md:w-24 md:h-24 rounded-full"
                     src="{{ $data['user']->profile_photo_url }}"
                     alt="{{ $data['user']->name }}"/>
                <p class="ml-5 text-lg font-bold">{{ $data['user']->name }}</p>
            </div>

        </div>

        <div class="tabs">
            <div class="tab-baslik">
                <div class="aktif">
                    <p>Oluşturdukları</p>
                   @if($data['quizler']->count()) <p style="margin: 0; font-size: 9pt;">{{ $data['quizler']->count() }}</p> @endif
                </div>
                <div>
                    <p>Çözdükleri</p>
                    @if($data['cozulenler']->count()) <p style="margin: 0; font-size: 9pt;">{{ $data['cozulenler']->count() }}</p> @endif
                </div>
            </div>
            <div class="tab-bg"></div>
            <div class="tab-indicator"></div>
        </div>

        <div>
            <div class="posts flex flex-wrap mx-1 overflow-hidden">
                @forelse($data['quizler'] as $quiz)
                    @include('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['user']->id])
                @empty
                    <div class="text-center text-gray-600 w-full p-10 border border-gray-200 rounded-md bg-gray-100"><p>Bu kullanıcı hiç Quiz oluşturmamış.</p></div>
                @endforelse
            </div>
            <div class="posts flex flex-wrap mx-1 overflow-hidden" style="opacity: 0; height: 0;">

                @forelse($data['cozulenler'] as $quiz)
                        @include('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['user']->id, 'puan' => $quiz->getUserScore($data['user']->id)])
                @empty
                    <div class="text-center text-gray-600 w-full p-10 border border-gray-200 rounded-md bg-gray-100"><p>Bu kullanıcı hiç Quiz çözmemiş.</p></div>
                @endforelse
            </div>
        </div>
    </div>
    <script src="/js/profil.js"></script>
</x-app-layout>

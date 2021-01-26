<x-app-layout>
    <x-slot name="header">Anasayfa</x-slot>
    <div class="flex flex-row p-3 items-center bg-gray-50 border-b border-gray-200">
        <p class="text-lg"><img src="/storage/img/anasayfa.svg" alt="" class="w-7 h-7 mr-1 inline"><span
                class="font-bold align-middle">Akışım</span></p>
    </div>


    @if ($data['quizzes']->count())
        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            @foreach($data['quizzes'] as $quiz)
                @include('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['uid']])
            @endforeach
        </div>
    @else
        <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
            <p class="text-gray-600">Takip ettiğin kategorilerdeki Quizler burada görünecek. </p>
            <p class="text-gray-600">Görünüşe göre henüz bir kategori takip etmiyorsun.</p><br>
            <p class="text-lg">Quizleri keşfet!</p>
            <a href="{{route('quizler.index')}}">
                <button
                    type="button"
                    class="btn btn--primary mr-2 my-2">
                    <i class="fa fa-fire"></i> Popüler Quizler
                </button>
            </a>

            <p class="text-gray-600 my-5">-veya-</p>

            <p class="text-lg">Hemen bir Quiz oluştur!</p>
            <a href="{{route('quizler.create')}}">
                <button
                    type="button"
                    class="btn btn--primary mr-2 my-2">
                    <i class="fa fa-plus"></i> Quiz Oluştur
                </button>
            </a>
        </div>
    @endif

</x-app-layout>

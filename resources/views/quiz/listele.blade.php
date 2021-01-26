<x-app-layout>
    <x-slot name="header">Quizler</x-slot>

    <div>
        <div class="flex justify-between bg-gray-200 border-b border-gray-300 py-2 shadow-inner">
            <div id="kat"
                 class="absolute ml-3 border bg-blue-100 border-blue-200 my-1 mr-3 py-1 px-3 rounded-md z-10 transition duration-500 max-w-3xl">
                <div>
                    <div id="kategori-btn" class="cursor-pointer">
                        <img src="https://www.flaticon.com/premium-icon/icons/svg/2735/2735293.svg" alt=""
                             class="w-9 h-9 inline-block">
                        <p class="inline">Kategoriler</p>
                    </div>
                    <div id="kategoriler" class="mt-5 hidden">

                        <div class="hidden lg:block">
                            @foreach($data['kategoriler'] as $kategori)
                                <a href="/kategori/{{ $kategori->link }}">
                                    <div class="kategori {{ $kategori->renk }} inline-block"
                                         style="background-image: url({{ $kategori->icon }});">
                                        <p>{{ $kategori->isim }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="flex lg:hidden">
                            <div class="">
                                @foreach($data['kategoriler'] as $kategori)
                                    @if ($loop->index % 2 == 0)
                                        <a href="/kategori/{{ $kategori->link }}">
                                            <div class="kategori {{ $kategori->renk }}"
                                                 style="background-image: url({{ $kategori->icon }});">
                                                <p>{{ $kategori->isim }}</p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="">
                                @foreach($data['kategoriler'] as $kategori)
                                    @if ($loop->index % 2 != 0)
                                        <a href="/kategori/{{ $kategori->link }}">
                                            <div class="kategori {{ $kategori->renk }}"
                                                 style="background-image: url({{ $kategori->icon }});">
                                                <p>{{ $kategori->isim }}</p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div>
            </div>

            <div>
                <a href="{{route('quizler.create')}}">
                    <button
                        type="button"
                        class="btn btn--primary mr-2 my-2">
                        <i class="fa fa-plus"></i> Yeni Oluştur
                    </button>
                </a>
            </div>
        </div>

        @isset($data['kategori'])
            <div
                class="flex flex-row p-3 items-center @if ($data['quizzes']->count()) bg-blue-100 @else bg-red-200 @endif">
                @if ($data['quizzes']->count())
                    <p class="text-sm"><img src="{{ $data['kategori']->icon }}" alt="" class="w-5 h-5 mr-1 inline"><span
                            class="font-bold">{{ $data['kategori']->isim }}</span>
                        kategorisinde <b>{{ $data['quizzes']->count() }}</b> adet quiz bulundu</p>
            </div>
            <hr>
        @else
            <p class="text-sm"><img src="{{ $data['kategori']->icon }}" alt="" class="w-5 h-5 mr-1 inline"><span
                    class="font-bold">{{ $data['kategori']->isim }}</span> kategorisinde hiç quiz bulunamadı!</p>
    </div>
    <hr>
    @endif

    <div class="flex flex-row p-2 items-center bg-gray-50 justify-between">
        <p class="text-lg"><img src="{{ $data['kategori']->icon }}" alt="" class="w-7 h-7 mr-1 inline"><span
                class="font-bold align-middle ip5:text-sm">{{ $data['kategori']->isim }}</span></p>

        <form method="post" action="">
            @csrf
            @if ($data['takip'])
                <button
                    class="rounded-md px-2 py-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-red-300 bg-red-200 hover:bg-red-400  ml-2">
                    <i class="fas fa-times text-red-600"></i> <span
                        class="ip5:text-sm">Bu kategoriyi takibi bırak</span>
                </button>
            @else
                <button
                    class="rounded-md px-2 py-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-gray-300 bg-gray-200 hover:bg-green-200  ml-2">
                    <i class="fas fa-heart text-red-600 text-xl"></i> <span
                        class="ip5:text-sm">Bu kategoriyi takip et</span>
                </button>
            @endif
        </form>
    </div>
    <hr>
    @else
        <div class="flex flex-row p-3 items-center bg-gray-50 border-b border-gray-200">
            <p class="text-lg"><img src="/storage/img/trending.svg" alt="" class="w-7 h-7 mr-1 inline"><span
                    class="font-bold align-middle">Popüler Quizler</span></p>
        </div>
    @endisset



    @isset($data['kategori'])
        @if(!$data['quizzes'] -> count())
            <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
                <p class="text-gray-600">Bu kategoride henüz hiç quiz oluşturulmamış.</p><br>
                <p class="text-lg">İlk oluşturan sen ol!</p>
                <a href="{{route('quizler.create')}}">
                    <button
                        type="button"
                        class="btn btn--primary mr-2 my-2">
                        <i class="fa fa-plus"></i> Quiz Oluştur
                    </button>
                </a>
            </div>
        @endif

        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            @foreach($data['quizzes'] as $quiz)
                @include('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['uid']])
            @endforeach
        </div>
    @else
        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            @foreach($qdata as $q)
                @include('quiz.templates.quiz-box', ['quiz' => $data['quizzes']->where('id', $q->id)->first(), 'kategori' => $data['kategoriler']->where('link', $data['quizzes']->where('id', $q->id)->first()->kategori)->first()->isim, 'userid' => $data['uid']])
            @endforeach
        </div>

    @endisset
    <div class="px-5 pb-5">{{$data['quizzes']->links()}}</div>

</x-app-layout>

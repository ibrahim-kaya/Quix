<div class="my-2 pr-1 xl:pr-2 pl-1 w-full overflow-hidden xl:w-1/3 md:w-2/4 h-60">
    <div
        class="relative bg-blue-50 hover:bg-blue-100 transition duration-300 border border-blue-200 h-full rounded-lg relative overflow-hidden shadow-md shadow-inner">

        @if(isset($puan))
            <div
                class="bg-green-500 absolute right-0 py-1 px-2 rounded-md opacity-80 rounded-br-none rounded-tl-none text-white">
                <i class="fas fa-star"></i> Puan: <b>{{ $puan }}</b>
            </div>
        @else
            @if($quiz->quizCozdu($userid))
                <div
                    class="bg-green-500 absolute right-0 py-1 px-2 rounded-md opacity-80 rounded-br-none rounded-tl-none text-white">
                    <i class="fas fa-check"></i> Çözüldü
                </div>
            @endif
        @endif


        <div class="flex justify-center h-32 overflow-hidden">
            <a href="{{ route('quizler.show', $quiz->uniqueid) }}"><img
                    src="{{ $quiz->resim }}"
                    alt="Quiz Resim" class="w-full" onerror="this.src='https://agentmajeur.fr/wp-content/uploads/femme-question-bleue-1.jpg'"></a>
        </div>
        <a href="{{ route('quizler.show', $quiz->uniqueid) }}" class="p-3 yazi-kisalt"
           title="{{ $quiz->baslik }}">{{ $quiz->baslik }}</a><br>
        <span class="px-3 py-2 text-xs text-gray-500 absolute bottom-0 mb-4">Oluşturan: <a href="{{ route('profil', $quiz->getUser->name) }}"
                                                                                           class="text-black">{{ $quiz->getUser->name }}</a>&nbsp;&nbsp;·
                        <span class="text-xs ml-1 text-gray-500">{{ $quiz->created_at->diffForHumans() }}</span>
                        </span>

        <span class="px-3 py-1 text-xs text-gray-500 absolute bottom-0">Kategori: <a
                href="{{ route('kategori', $quiz->kategori) }}"
                class="text-blue-500">{{ $kategori }}</a>
                        </span>
    </div>
</div>

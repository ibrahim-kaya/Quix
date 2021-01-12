<x-app-layout>
    <x-slot name="header">Quizler</x-slot>

    <div>
        <div class="flex justify-between bg-gray-200 border-b border-gray-300 py-2 shadow-inner">
            <div>
                blabla
            </div>

            <div>
            <a href="{{route('quizler.create')}}"><button
                    type="button"
                    class="btn btn--primary mr-2 my-2">
                    <i class="fa fa-plus"></i> Yeni Oluştur
                </button></a>
            </div>
        </div>

        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">

            @foreach($data['quizzes'] as $quiz)
                <div class="my-2 pr-1 xl:pr-2 pl-1 w-full overflow-hidden xl:w-1/3 md:w-2/4 h-56">
                    <div class="relative bg-blue-50 hover:bg-blue-100 transition duration-300 border border-blue-200 h-full rounded-lg relative overflow-hidden shadow-md shadow-inner">
                        @if(\App\Models\Cevap::where('userid', \Illuminate\Support\Facades\Auth::user()->id)->get()->where('soru_id', \App\Models\Soru::where('quiz_id', $quiz->id)->get()->first()->id)->count())
                            <div class="bg-green-500 absolute right-0 py-1 px-2 rounded-md opacity-80 rounded-br-none rounded-tl-none text-white">
                                <i class="fas fa-check"></i> Çözüldü
                            </div>
                        @endif

                        <div class="flex justify-center h-32 overflow-hidden">
                            <a href="{{ route('quizler.show', $quiz->uniqueid) }}"><img src="https://agentmajeur.fr/wp-content/uploads/femme-question-bleue-1.jpg" alt="Quiz Resim" class="w-full"></a>
                        </div>
                        <a href="{{ route('quizler.show', $quiz->uniqueid) }}" class="p-3 yazi-kisalt" title="{{ $quiz->baslik }}">{{ $quiz->baslik }}</a><br>
                        <span class="p-3 text-xs text-gray-500 absolute bottom-0">Oluşturan: <a href="#" class="text-black">{{ $quiz->getUser->name }}</a>&nbsp;&nbsp;·
                        <span class="text-xs ml-1 text-gray-500">7 May 2021</span>
                        </span>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="px-5 pb-5">{{$data['quizzes']->links()}}</div>
    </div>

</x-app-layout>

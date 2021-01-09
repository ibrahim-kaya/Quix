<x-app-layout>
    <x-slot name="header">Quiz Düzenle</x-slot>

    <form method="POST" action="{{ route('quizler.update', $quiz->id) }}">
        @method('PUT')
        @csrf

        <div class="px-5 py-5">
            @if(\Illuminate\Support\Facades\Auth::user()->type === 'admin')
                <div class="flex flex-col text-sm mb-5">
                    <label class="font-bold mb-2">Quizi Oluşturan</label>
                    <a href="#" title="Profile git" class="w-max">
                        <div class="flex items-center bg-gray-100 border border-gray-300 shadow-inner rounded-md px-3 py-1 w-max hover:opacity-80 transition duration-500">
                            <div class="flex-shrink-0 w-10 h-10">
                                <img class="w-full h-full rounded-full"
                                     src="{{ $quiz->getUser->profile_photo_url }}"
                                     alt="{{ $quiz->getUser->name }}" />
                            </div>
                            <div class="ml-3">
                                <p class="text-blue-500 whitespace-no-wrap font-bold">
                                    {{ $quiz->getUser->name }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="flex flex-col text-sm">
                <label class="font-bold mb-2">Quiz Başlığı</label>
                <input class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500" type="text" name="baslik" placeholder="Bir başlık yazın" value="{{ $quiz->baslik }}">
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Açıklaması (Opsiyonel)</label>
                <textarea name="aciklama" class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500" placeholder="Bir açıklama yazın...">{{ $quiz->aciklama }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn--primary mb-5 ml-5">Quiz Güncelle</button>
    </form>
</x-app-layout>

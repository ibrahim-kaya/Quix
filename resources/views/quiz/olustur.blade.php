<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>

    <form method="POST" action="{{route('quizler.store')}}">
        @csrf

        <div class="px-5 py-5">
            <div class="flex flex-col text-sm">
                <label class="font-bold mb-2">Quiz Başlığı</label>
                <input class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500" type="text" name="baslik" placeholder="Bir başlık yazın" value="{{old('baslik')}}">
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Açıklaması (Opsiyonel)</label>
                <textarea name="aciklama" class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500" placeholder="Bir açıklama yazın...">{{old('aciklama')}}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn--primary">Quiz Oluştur</button>
    </form>
</x-app-layout>

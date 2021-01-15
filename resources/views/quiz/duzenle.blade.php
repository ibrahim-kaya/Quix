<x-app-layout>
    <x-slot name="header">Quiz Düzenle</x-slot>

    <div class="flex justify-between border-b bg-gray-200 border-gray-300">
        <div class="border-r border-green-300"><a href="{{ route('quizlerim.index') }}"><p
                    class="hover:bg-gray-300 py-3 px-5 font-bold" style="transition: all .4s;"><i
                        class="fas fa-chevron-left"></i> Geri</p></a></div>
    </div>

    <form method="POST" action="{{ route('quizler.update', $data['quiz']->id) }}">
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
                                     src="{{ $data['quiz']->getUser->profile_photo_url }}"
                                     alt="{{ $data['quiz']->getUser->name }}" />
                            </div>
                            <div class="ml-3">
                                <p class="text-blue-500 whitespace-no-wrap font-bold">
                                    {{ $data['quiz']->getUser->name }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="flex flex-col text-sm">
                <label class="font-bold mb-2">Quiz Başlığı</label>
                <input class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500" type="text" name="baslik" placeholder="Bir başlık yazın" value="{{ $data['quiz']->baslik }}">
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Açıklaması (Opsiyonel)</label>
                <textarea name="aciklama" class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500" placeholder="Bir açıklama yazın...">{{ $data['quiz']->aciklama }}</textarea>
            </div>

                <div class="text-sm flex flex-col">
                    <label class="font-bold mt-4 mb-2">Quiz Kategorisi</label>
                    <select name="kategori" class=" appearance-none w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">
                        <option value="" disabled>Bir kategori seçin...</option>
                        @foreach($data['kategoriler'] as $kategori)
                            <option value="{{ $kategori->link }}" @if($data['quiz']->kategori == $kategori->link) selected @endif>{{ $kategori->isim }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-sm flex flex-col">
                    <label class="font-bold mt-4 mb-2">Quiz Gizliliği</label>
                    <select name="gizlilik" class=" appearance-none w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">
                        <option value="0" @if(!$data['quiz']->gizlilik) selected @endif>Herkese açık</option>
                        <option value="1" @if($data['quiz']->gizlilik) selected @endif>Liste dışı (Sadece linke tıklayarak ulaşılabilinsin)</option>
                    </select>
                </div>
        </div>
        <div class="ml-5 mb-5">
        <button type="submit" class="btn--primary mb-1.5">Quiz Güncelle</button>
        <a href="{{ route('sorular.index', $data['quiz']->uniqueid) }}" class="btn--orange inline-block">Soruları Düzenle</a>
        </div>
    </form>
</x-app-layout>

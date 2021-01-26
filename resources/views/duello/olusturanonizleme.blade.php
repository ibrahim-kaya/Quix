<x-app-layout>
    <x-slot name="header">Düello</x-slot>

    <div class="flex flex-wrap justify-center mt-5 items-center">
        <img src="/storage/img/duello/duello.svg" alt="" class="w-32 h-32">
        <div class="w-full"></div>
        <h1 class="text-3xl font-bold mt-3">Düello</h1>
        <div class="w-full"></div>
        <div class="mt-5">

                <p class="text-center text-gray-500">Gönderilen:</p>
                @include('quiz.templates.user-card', ['user' => $data['user2'], 'bg' => 'bg-gray-100', 'border' => 'border-gray-300'])

        </div>
        <div class="w-full"></div>
        <p class="mt-5">Kategori: <b>{{ $data['kategori']->isim }}</b></p>
    </div>

    <p id="demo"></p>

    <div class="m-5 p-5 bg-gray-100 border border-gray-200 rounded-md">
        <p>Düelloya başlamaya hazırsın!</p>
        <p>Şimdi elinden geleni yap ve arkadaşına yeteneklerini göster!</p>
        <br>
        <div class="text-center sm:flex sm:justify-center">
            <form method="post" action="{{ route('testEkrani', $data['duello']->uniqueid) }}">
                @csrf
                <button class="btn--primary mt-1.5">Düelloya Başla</button>
            </form>
        </div>
    </div>

    <div class="m-5">
        <p class="text-gray-600 mt-10">Dikkat!</p>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Düello; seçeceğin bir arkadaşınla birebir yaptığın bilgi
            yarışmasıdır.
        </li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Düelloyu oluşturduktan sonra 3 gün içinde iki tarafta
            soruları cevaplamalıdır. Aksi halde düello iptal olur.
        </li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Her soru için 45 saniye süren var. Ne kadar kısa sürede
            cevaplarsan o kadar fazla puan alırsın.
        </li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Süre dolduğunda soruyu cevaplamamışsan soru boş
            bırakılıp diğer soruya geçilecektir.
        </li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Eğer düello esnasında sayfayı kapatırsan mevcut soru
            boş bırakılacaktır. Sonraki girişinde kaldığın sorudan devam edebilirsin.
        </li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Önceki soruya geri dönemezsin. O yüzden seçimini iyi
            yap.
        </li>
    </div>


</x-app-layout>
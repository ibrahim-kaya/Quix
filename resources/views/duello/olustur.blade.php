<x-app-layout>
    <x-slot name="header">Düello</x-slot>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


    <div class="flex flex-wrap justify-center mt-5">
        <img src="/storage/img/duello/duello.svg" alt="" class="w-32 h-32">
        <div class="w-full"></div>
        <h1 class="text-3xl font-bold mt-3">Düello Oluştur</h1>
    </div>

    <div class="p-3">
        <p>Düelloya hoşgeldin! Bir konuda ne kadar iyi olduğunu arkadaşına ispat etmek mi istiyorsun? O zaman doğru
            yerdesin! Hemen bir düello oluşturup ne kadar iyi olduğunu kanıtla!</p>
        <p>İstediğin bir konuyu ve yarışmak istediğin arkadaşını seç ve rastgele seçilmiş 10 soru ile hazırlanmış bilgi
            yarışmasını başlat!</p>

        <div class="mt-10 bg-gray-100 p-3 rounded-md border border-gray-200">
            <form method="post" action="">
                @csrf

                <div class="flex flex-col text-sm">
                    <label class="font-bold mb-2">Düello yapmak istediğin kullanıcının adını yaz:</label>
                    <input id="search" name="isim" type="text" class="form-control" placeholder="Bir kullanıcı adı yaz..." value="{{old('isim')}}" />
                </div>

                <div class="text-sm flex flex-col">
                    <label class="font-bold mt-4 mb-2">Düello Kategorisi</label>
                    <select name="kategori" class="rounded-md appearance-none w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">
                        <option value="" selected disabled>Bir kategori seçin...</option>
                        @foreach($data['kategoriler'] as $kategori)
                            <option value="{{ $kategori->link }}">{{ $kategori->isim }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end mt-3"><button type="submit" class="btn--primary"><i class="fas fa-paper-plane"></i> İstek Gönder</button></div>
            </form>
        </div>


        <p class="text-gray-600 mt-10">Dikkat!</p>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Düello; seçeceğin bir arkadaşınla birebir yaptığın bilgi yarışmasıdır.</li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Düelloyu oluşturduktan sonra 3 gün içinde iki tarafta soruları cevaplamalıdır. Aksi halde düello iptal olur.</li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Her soru için 45 saniye süren var. Ne kadar kısa sürede cevaplarsan o kadar fazla puan alırsın.</li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Süre dolduğunda soruyu cevaplamamışsan rastgele bir şık seçilip diğer soruya geçilecektir.</li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Eğer düello esnasında sayfayı kapatırsan mevcut soru rastgele işaretlenecektir. Sonraki girişinde kaldığın sorudan devam edebilirsin.</li>
        <li class="text-gray-600 ml-3 text-sm mt-1.5 leading-4">Önceki soruya geri dönemezsin. O yüzden seçimini iyi yap.</li>

    </div>

    <script type="text/javascript">
        var route = "{{ url('autocomplete') }}";
        $('#search').typeahead({
            source:  function (term, process) {
                return $.get(route, { term: term }, function (data) {
                    return process(data);
                });
            }
        });
    </script>

</x-app-layout>

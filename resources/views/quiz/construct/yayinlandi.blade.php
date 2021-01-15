<x-app-layout>
    <x-slot name="header">Quiz Yayınlandı!</x-slot>

    <div class="p-5">
    <h1 class="text-2xl font-bold text-green-600"><i class="fas fa-check"></i> Quizin başarıyla yayınlandı!</h1>
        <br>
    <p>Quiz'ini yayınladık. Şimdi arkana yaslanıp insanların Quiz'ine verdiği cevapları izleyebilirsin!</p><br>
        @if ($quiz->gizlilik)
            <p>Quiz'ini <b>liste dışı</b> olarak ayarladığın için insanlar onu kategori sayfalarında veya anasayfalarında göremezler. Aşağıdaki linki Quiz'ini çözmesini istediğin kişilere göndererek onlardan Quiz'ini çözmesini isteyebilirsin!</p>
            <br>
            <p>Quiz linki:</p>
            <input id="link" type="text" value="{{ route('quizler.show', $quiz->uniqueid) }}" class="w-full md:w-1/2 mb-2 rounded-md" readonly>
            <button class="btn--primary">Linki kopyala</button>
            <p id="msg" class="text-green-600" style="transition: all .4s; transform: scaleY(0)">Link Kopyalandı!</p>
            <br>
        @endif
        <a href="{{ route('anasayfa') }}"><button class="btn--primary"><i class="fas fa-home"></i> Anasayfaya Dön</button></a>
    </div>

    <script>
        $('button').click(function () {
            const copyText = document.getElementById("link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            $('#msg').css('transform', 'scaleY(1)');
        });
    </script>
</x-app-layout>

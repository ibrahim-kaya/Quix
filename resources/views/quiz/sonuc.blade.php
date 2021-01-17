<x-app-layout>
    @if (is_numeric($data['userid']))
        <x-slot name="header">{{ \App\Models\User::find($data['userid'])->name }} Quiz Sonucu</x-slot>
    @else
        <x-slot name="header">Quiz Sonucu</x-slot>
    @endif


    <div class="p-5 lg:p-10">
        <div class="p-5 pb-2 mb-10 bg-gray-200 border border-gray-300 shadow rounded-md">
            <h1 class="text-3xl font-bold text-green-600 mb-5 text-center">!! Quiz Sonuçları !!</h1>

            <h1 class="text-xl">Quiz:
                <spa class="font-bold">{{ $data['quiz']->baslik }}</span>
            </h1>
            <br>
            @if (is_numeric($data['userid']))
                <p>Çözen:</p>

                <div
                    class="font-bold text-blue-500 bg-gray-300 border border-gray-400 w-max p-1.5 px-4 rounded-xl mt-1 cursor-pointer hover:bg-gray-200 transition">
                    <img class="inline w-10 h-10 rounded-full"
                         src="{{ \App\Models\User::find($data['userid'])->profile_photo_url }}"
                         alt="{{ \App\Models\User::find($data['userid'])->name }}"/>
                    {{ \App\Models\User::find($data['userid'])->name }}
                </div>
            @endif

            <?php
            $dogru = 0;
            foreach ($data['sorular'] as $soru) {
                if ($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap) $dogru++;
            }
            ?>

            <p class="mt-5">Sonuçlar:</p>
            <p class="font-bold text-green-600"><i class="fas fa-check"></i> Doğru Cevap Sayısı: <span
                    class="text-lg">{{ $dogru }}</span></p>
            <p class="font-bold text-red-600"><i class="fas fa-times"></i> Yanlış Cevap Sayısı: <span
                    class="text-lg">{{ $data['sorular']->count() - $dogru }}</span></p>
            <br>
            @if ((\Illuminate\Support\Facades\Auth::check() && $data['userid'] == \Illuminate\Support\Facades\Auth::id()) || $data['userid'] == \Illuminate\Support\Facades\Session::getId())
                <br>
                <p>Sonucunu paylaş:</p>
                <input id="link" type="text"
                       value="{{ route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid]) }}"
                       class="w-full md:w-1/2 mb-2 rounded-md" readonly>
                <button class="btn--primary">Linki kopyala</button>
                <p id="msg" class="text-green-600" style="transition: all .4s; transform: scaleY(0)">Link
                    Kopyalandı!</p>
            @endif
            @if (!\Illuminate\Support\Facades\Auth::check())
                <br>
                <p class="text-sm text-gray-600">Sen de kendi Quiz'ini oluşturmak için hemen <a href="{{ route('register') }}" class="text-blue-500">kaydol!</a></p>
            @endif
        </div>
        <hr>
        <br>

        @foreach($data['sorular'] as $soru)
            <h1 class="text-lg pb-3 font-bold">{{ $loop->index+1 }}) {{ $soru->soru }}
                @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap)
                    <div
                        class="inline-block bg-green-500 border border-green-700 text-green-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm">
                        <i class="fas fa-check"></i> Doğru cevap!
                    </div>
                @else
                    <div
                        class="inline-block bg-red-500 border border-red-700 text-red-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm">
                        <i class="fas fa-times"></i> Yanlış cevap
                    </div>
                @endif
            </h1>

            @if($soru->resim)
                <img src="{{ $soru->resim }}" alt="" class="max-h-64 pb-3">
            @endif

            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap1') secilen @endif @if($soru->dogru_cevap == 'cevap1') dogru @endif">
                a) {{ $soru->cevap1 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap2') secilen @endif @if($soru->dogru_cevap == 'cevap2') dogru @endif">
                b) {{ $soru->cevap2 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap3') secilen @endif @if($soru->dogru_cevap == 'cevap3') dogru @endif">
                c) {{ $soru->cevap3 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap4') secilen @endif @if($soru->dogru_cevap == 'cevap4') dogru @endif">
                d) {{ $soru->cevap4 }}</p>
            <br><br>
            <hr><br>
        @endforeach
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

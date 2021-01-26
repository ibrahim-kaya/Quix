<x-app-layout>
    <link rel="stylesheet" href="/css/rate.css">

    <div class="p-5 lg:p-10">
        <div class="p-5 pb-2 mb-10 bg-gray-200 border border-gray-300 shadow rounded-md">
            <h1 class="text-2xl sm:text-3xl font-bold text-green-600 mb-5 text-center">!! Quiz Sonuçları !!</h1>

            <h1 class="text-xl">Quiz:
                <spa class="font-bold">{{ $data['quiz']->baslik }}</span>
            </h1>
            <br>

            <p>Çözen:</p>

            @include('quiz.templates.user-card', ['user' => $data['user'], 'bg' => 'bg-gray-300', 'border' => 'border-gray-400'])

            <?php
            $dogru = 0;
            foreach ($data['sorular'] as $soru) {
                if ($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap) $dogru++;
            }
            ?>

            <x-slot
                name="header">{{ $data['user']->name }}
                Quiz Sonucu ~ {{ $dogru }}/{{ $data['sorular']->count() }}</x-slot>

            <p class="mt-5">Sonuçlar:</p>
            <p class="font-bold text-green-600"><i class="fas fa-check"></i> Doğru Cevap Sayısı: <span
                    class="text-lg">{{ $dogru }}</span></p>
            <p class="font-bold text-red-600"><i class="fas fa-times"></i> Yanlış Cevap Sayısı: <span
                    class="text-lg">{{ $data['sorular']->count() - $dogru }}</span></p>
            <br>
            @if ((\Illuminate\Support\Facades\Auth::check() && $data['userid'] == \Illuminate\Support\Facades\Auth::id()) || $data['userid'] == 'u'.\Illuminate\Support\Facades\Session::getId())
                <br>
                <p>Sonucunu paylaş:</p>
                <input id="link" type="text"
                       value="{{ route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid]) }}"
                       class="w-full md:w-1/2 mb-2 rounded-md" readonly>
                <button id="kopyala" class="btn--primary">Linki kopyala</button>
                <p id="msg" class="text-green-600" style="transition: all .4s; transform: scaleY(0)">Link
                    Kopyalandı!</p>


            @if($data['puan']->count())
                <div><p>Bu Quiz'e {{ $data['puan']->first()->puan }} puan verdin.</p>
                    <div class="Stars " style="--rating: {{ $data['puan']->first()->puan }};"
                         aria-label="Bu Quiz'e 5 üzerinden {{ $data['puan']->first()->puan }} puan verdin.">
                    </div>
                </div>
            @else
                <form method="post" action="{{url('oyla')}}">
                    @csrf
                    <input type="hidden" name="uid" value="{{ $data['userid'] }}">
                    <input type="hidden" name="_id" value="{{ $data['quiz']->uniqueid }}">
                    <div
                        class="flex flex-wrap items-center flex-col sm:flex-row sm:w-max border-t border-b sm:border-t-0 sm:border-b-0 border-gray-300 py-3">
                        <p>Bu Quiz'i oyla:</p>
                        <div class="w-full"></div>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="puan" value="5"/><label class="full" for="star5"
                                                                                         title="Çok iyi - 5 yıldız"></label>
                            <input type="radio" id="star4" name="puan" value="4"/><label class="full" for="star4"
                                                                                         title="Fena değil - 4 yıldız"></label>
                            <input type="radio" id="star3" name="puan" value="3"/><label class="full" for="star3"
                                                                                         title="Eh işte - 3 yıldız"></label>
                            <input type="radio" id="star2" name="puan" value="2"/><label class="full" for="star2"
                                                                                         title="Pek beğenmedim - 2 yıldız"></label>
                            <input type="radio" id="star1" name="puan" value="1"/><label class="full" for="star1"
                                                                                         title="Hiç beğenmedim - 1 yıldız"></label>
                        </fieldset>
                        <button
                            class="rounded-md px-2 py-1 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-green-500 bg-green-500 text-white hover:bg-green-600 ml-3">
                            Oyla
                        </button>
                    </div>
                </form>
            @endif
            @endif


            @if (!\Illuminate\Support\Facades\Auth::check())
                <br>
                <p class="text-sm text-gray-600">Sen de kendi Quiz'ini oluşturmak istiyorsan hemen <a
                        href="{{ route('register') }}" class="text-blue-500">kaydol!</a></p>
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
        $('#kopyala').click(function () {
            const copyText = document.getElementById("link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            $('#msg').css('transform', 'scaleY(1)');
            setTimeout(function () {
                $('#msg').css('transform', 'scaleY(0)');
            }, 5000);
        });
    </script>
</x-app-layout>

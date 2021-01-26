<x-app-layout>
    <x-slot name="header">Quizler</x-slot>

    <div class="p-5 lg:p-10">
        <p class="text-2xl">Quiz: <b>{{ $data['quiz']->baslik }}</b></p>
        <p class="mt-2">{!! nl2br(e($data['quiz']->aciklama)) !!}</p>
        <br>
        <form method="post" action="{{ route('sonuc') }}">
            @csrf
            <input hidden name="__id" value="{{ $data['quiz']->id }}">
            <input hidden name="_id" value="{{ $data['quiz']->uniqueid }}">
            <input hidden name="isim" value="{{ $data['isim'] }}">
            @foreach($data['sorular'] as $soru)
                <h1 class="text-lg pb-3 font-bold">{{ $loop->index+1 }}) {{ $soru->soru }}</h1>
                <input type="hidden" name="cevaplar[{{ $loop->index }}][soru]" value="{{$soru->id}}">

                @if($soru->resim)
                    <img src="{{ $soru->resim }}" alt="" class="max-h-64 pb-3">
                @endif

                <input type="radio" id="cevap{{$soru->id}}-1" name="cevaplar[{{ $loop->index }}][cevap]" class="hidden secenek" value="cevap1" @if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap1') checked @endif>
                <label for="cevap{{$soru->id}}-1"><span class="text-lg font-bold">a)</span> {{ $soru->cevap1 }}</label><br>

                <input type="radio" id="cevap{{$soru->id}}-2" name="cevaplar[{{ $loop->index }}][cevap]" class="hidden secenek" value="cevap2" @if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap2') checked @endif>
                <label for="cevap{{$soru->id}}-2"><span class="text-lg font-bold">b)</span> {{ $soru->cevap2 }}</label><br>

                <input type="radio" id="cevap{{$soru->id}}-3" name="cevaplar[{{ $loop->index }}][cevap]" class="hidden secenek" value="cevap3" @if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap3') checked @endif>
                <label for="cevap{{$soru->id}}-3"><span class="text-lg font-bold">c)</span> {{ $soru->cevap3 }}</label><br>

                <input type="radio" id="cevap{{$soru->id}}-4" name="cevaplar[{{ $loop->index }}][cevap]" class="hidden secenek" value="cevap4" @if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap4') checked @endif>
                <label for="cevap{{$soru->id}}-4"><span class="text-lg font-bold">d)</span> {{ $soru->cevap4 }}</label><br>

                <br>@if($loop->index < $loop->count - 1) <hr><br> @endif

                <?php
                /*$value = $data['sorular']->where('id', '=', '60');
                <p>5. sorunun cevabı: {{ $value->first()->dogru_cevap }}</p>*/
                ?>
            @endforeach

            <button type="submit" class="btn btn--primary w-full lg:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Sonucumu Göster</button>
        </form>
    </div>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">{{ \App\Models\User::find($data['userid'])->name }} Quiz Sonucu</x-slot>

    <div class="p-5 lg:p-10">
        <div class="p-5 mb-10 bg-gray-200 border border-gray-300 shadow rounded-md">
            <h1 class="text-3xl font-bold text-green-600 mb-5 text-center">!! Quiz Sonuçları !!</h1>

            <h1 class="text-xl">Quiz: <spa class="font-bold">{{ $data['quiz']->baslik }}</span></h1>
            <br>
            <p>Çözen:</p>

            <div class="font-bold text-blue-500 bg-gray-300 border border-gray-400 w-max p-1.5 px-4 rounded-xl mt-1 cursor-pointer hover:bg-gray-200 transition">
                <img class="inline w-10 h-10 rounded-full"
                     src="{{ \App\Models\User::find($data['userid'])->profile_photo_url }}"
                     alt="{{ \App\Models\User::find($data['userid'])->name }}" />
                    {{ \App\Models\User::find($data['userid'])->name }}
            </div>

            <?php
            $dogru = 0;
            foreach($data['sorular'] as $soru){
                if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap) $dogru++;
            }
            ?>

            <p class="mt-5">Sonuçlar:</p>
            <p class="font-bold text-green-600"><i class="fas fa-check"></i> Doğru Cevap Sayısı: <span class="text-lg">{{ $dogru }}</span></p>
            <p class="font-bold text-red-600"><i class="fas fa-times"></i> Yanlış Cevap Sayısı: <span class="text-lg">{{ $data['sorular']->count() - $dogru }}</span></p>
        </div>
        <hr>
        <br>

        @foreach($data['sorular'] as $soru)
            <h1 class="text-lg pb-3 font-bold">{{ $loop->index+1 }}) {{ $soru->soru }}
                @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap)
                    <div class="inline-block bg-green-500 border border-green-700 text-green-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm"><i class="fas fa-check"></i> Doğru cevap!</div>
                @else
                    <div class="inline-block bg-red-500 border border-red-700 text-red-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm"><i class="fas fa-times"></i> Yanlış cevap</div>
                @endif
            </h1>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap1') secilen @endif @if($soru->dogru_cevap == 'cevap1') dogru @endif">a) {{ $soru->cevap1 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap2') secilen @endif @if($soru->dogru_cevap == 'cevap2') dogru @endif">b) {{ $soru->cevap2 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap3') secilen @endif @if($soru->dogru_cevap == 'cevap3') dogru @endif">c) {{ $soru->cevap3 }}</p>
            <p class="secenek-box @if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap4') secilen @endif @if($soru->dogru_cevap == 'cevap4') dogru @endif">d) {{ $soru->cevap4 }}</p>
            <br><br><hr><br>
        @endforeach
    </div>
</x-app-layout>

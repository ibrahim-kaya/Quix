<x-app-layout>
    <x-slot name="header">Düello</x-slot>

    @if ($data['mesaj'])
        <div class="flex flex-wrap w-full justify-center bg-gray-100 text-center p-2 mb-5 border-b border-gray-200">
            <h1 class="text-2xl font-bold @if ($data['puan']) text-green-600 @else text-red-600 @endif">{{ $data['mesaj'] }}</h1>
            <div class="w-full"></div>
            <img src="@if ($data['puan']) /storage/img/duello/dogru.webp @else /storage/img/duello/yanlis.webp @endif"
                 alt="" class="h-36 rounded-md my-2">
            <div class="w-full"></div>
            <p class="@if ($data['puan']) text-green-600 @else text-red-600 @endif">+{{ $data['puan'] }} Puan</p>
        </div>
    @endif

    <p class="text-center mb-2">Kalan Süre: <b id="sayac" class="text-xl">00:45</b></p>

    <form method="post" action="" class="px-5">
        @csrf
        <h1 class="text-lg pb-3 font-bold">Soru {{ $data['index'] }}: {{ $data['soru']->soru }}</h1>

        @if($data['soru']->resim)
            <img src="{{ $data['soru']->resim }}" alt="" class="max-h-64 pb-3">
        @endif

        <input type="radio" id="cevap-1" name="cevap" class="hidden secenek" value="cevap1">
        <label for="cevap-1"><span class="text-lg font-bold">a)</span> {{ $data['soru']->cevap1 }}</label><br>

        <input type="radio" id="cevap-2" name="cevap" class="hidden secenek" value="cevap2">
        <label for="cevap-2"><span class="text-lg font-bold">b)</span> {{ $data['soru']->cevap2 }}</label><br>

        <input type="radio" id="cevap-3" name="cevap" class="hidden secenek" value="cevap3">
        <label for="cevap-3"><span class="text-lg font-bold">c)</span> {{ $data['soru']->cevap3 }}</label><br>

        <input type="radio" id="cevap-4" name="cevap" class="hidden secenek" value="cevap4">
        <label for="cevap-4"><span class="text-lg font-bold">d)</span> {{ $data['soru']->cevap4 }}</label><br>
        <br>
        <button type="submit" class="btn btn--primary w-full lg:w-1/2 font-bold"><i class="fas fa-check-circle"></i>
            Onayla
        </button>
        <br>
        <p class="text-sm text-gray-600 mt-10"> Soruyu ekleyen: <a href="{{ route('profil', $data['soru_user']->name) }}" class="text-blue-500 font-bold">{{ $data['soru_user']->name }}</a></p>
    </form>

    <script>
        setTimeout(
            function () {
                const form = document.createElement('form');
                form.method = 'post';
                form.action = '';


                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = '_token';
                hiddenField.value = '{{ csrf_token() }}';

                form.appendChild(hiddenField);


                document.body.appendChild(form);
                form.submit();
            }, 45000);

        const countDownDate = new Date();
        countDownDate.setSeconds(countDownDate.getSeconds() + 45);

        const x = setInterval(function () {
            const now = new Date().getTime();
            const distance = countDownDate - now;
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("sayac").innerHTML = "00:" + seconds;
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("sayac").innerHTML = "SÜRE DOLDU";
            }
        }, 1000);

    </script>
</x-app-layout>

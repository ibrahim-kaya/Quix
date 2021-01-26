<x-app-layout>
    <x-slot name="header">Düello</x-slot>

    @if ($data['u1_durum'] == 2 && $data['u2_durum'] == 2)
        <div class="flex flex-wrap justify-center mt-5">
            <img src="/storage/img/duello/duello.svg" alt="" class="w-32 h-32">
            <div class="w-full"></div>
            <h1 class="text-3xl font-bold mt-3">Düello Sonucu</h1>
        </div>

        <div class="bg-gray-200 border border-gray-300 rounded-md mt-10 pb-5 sm:max-w-xl mx-auto">
            <div class="relative">
                <img src="/storage/img/duello/kazanan.svg" alt=""
                     class="w-16 absolute inset-x-0 mx-auto -mt-7 rounded-lg rounded-t-none">
            </div>
            <p class="mt-10 text-center text-xl font-bold text-green-600">Kazanan:</p>

            <div class="flex flex-wrap justify-center mt-2">
                @include('quiz.templates.user-card', ['user' => ($data['u1_puan'] >= $data['u2_puan']) ? $data['user1'] : $data['user2'], 'bg' => 'bg-gray-100', 'border' => 'border-gray-300'])
                <div class="w-full"></div>
                <p class="text-green-600 mt-5 text-lg"><i class="fas fa-star"></i> <b>{{ ($data['u1_puan'] >= $data['u2_puan']) ? $data['u1_puan'] : $data['u2_puan'] }} puan</b></p>
            </div>
        </div>

        <p class="mt-3 px-5 text-center text-gray-600 mb-10"><b class="text-black"><a href="{{ route('profil', ($data['u1_puan'] >= $data['u2_puan']) ? $data['user2']->name : $data['user1']->name) }}" class="text-blue-500">{{ ($data['u1_puan'] >= $data['u2_puan']) ? $data['user2']->name : $data['user1']->name }}</a> {{ ($data['u1_puan'] >= $data['u2_puan']) ? $data['u2_puan'] : $data['u1_puan'] }}</b> puan alarak düelloyu kaybetti. Bir dahaki sefere bol şans.</p>
    @else
        <div class="flex flex-wrap justify-center mt-5">
            <img src="/storage/img/duello/duello.svg" alt="" class="w-32 h-32">
            <div class="w-full"></div>
            <h1 class="text-3xl font-bold mt-3">Sonuçlar Bekleniyor...</h1>
        </div>

        <div class="mt-10 bg-gray-100 rounded-md border border-gray-200 sm:m-5 rounded-md text-center">
            <div class="sm:flex sm:justify-between sm:justify-around items-center py-1">
                <a href="{{ route('profil', $data['user1']->name) }}" title="Profile git" class="w-max">
                    <div class="font-bold flex items-center justify-center">
                        <img class="inline w-10 h-10 rounded-full"
                             src="{{ $data['user1']->profile_photo_url }}"
                             alt="{{ $data['user1']->name }}"/>
                        <p class="ml-2 text-blue-500">{{ $data['user1']->name }}</p>
                    </div>
                </a>
                <div>
                    <div
                        class="@if($data['u1_durum'] == 2) text-white bg-green-400 border border-green-500 @else bg-yellow-200 border border-yellow-300 text-gray-600 @endif rounded-md p-1 text-center">
                        @if($data['u1_durum'] == 2)
                            <p><i class="fas fa-star"></i> Puan: {{ $data['u1_puan'] }}</p>
                        @else
                            <p>Sonuç Bekleniyor...</p>
                        @endif
                    </div>
                </div>
            </div>
            <div
                class="sm:flex sm:justify-between sm:justify-around items-center py-1 mt-5 py-5 border-t border-gray-300">
                <a href="{{ route('profil', $data['user2']->name) }}" title="Profile git" class="w-max">
                    <div class="font-bold flex items-center justify-center">
                        <img class="inline w-10 h-10 rounded-full"
                             src="{{ $data['user2']->profile_photo_url }}"
                             alt="{{ $data['user2']->name }}"/>
                        <p class="ml-2 text-blue-500">{{ $data['user2']->name }}</p>
                    </div>
                </a>
                <div>
                    <div
                        class="@if($data['u2_durum'] == 2) text-white bg-green-400 border border-green-500 @else bg-yellow-200 border border-yellow-300 text-gray-600 @endif rounded-md p-1 text-center">
                        @if(!$data['u2_durum'])
                            <p>Henüz kabul etmedi...</p>
                        @elseif($data['u2_durum'] == 1)
                            <p>Sonuç Bekleniyor...</p>
                        @else
                            <p><i class="fas fa-star"></i> Puan: {{ $data['u2_puan'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

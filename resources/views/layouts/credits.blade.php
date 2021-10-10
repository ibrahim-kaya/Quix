<x-app-layout>
    <x-slot name="header">Katkıda Bulunanlar</x-slot>

    <style>
        a {
            color: cornflowerblue;
        }

        b {
            color: #606f7b;
        }

        li {
            margin-left: 20px;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>

    <div class="flex flex-col sm:flex-row justify-around bg-gray-200 text-center">
        <a class="@if(Route::currentRouteName() === 'credits_1') c_aktif" @else c_pasif" href="{{ route('credits_1') }}
        " @endif style="border-left: 0;">
        <div>Kullanılan Görseller</div>
        </a>
        <a class="@if(Route::currentRouteName() === 'credits_2') c_aktif" @else c_pasif" href="{{ route('credits_2') }}
        " @endif>
        <div>Sec 2</div>
        </a>
        <a class="@if(Route::currentRouteName() === 'credits_3') c_aktif" @else c_pasif" href="{{ route('credits_3') }}
        " @endif>
        <div>Sec 3</div>
        </a>
    </div>

    <div class="p-3 mt-3">
        @yield('content')
    </div>

</x-app-layout>

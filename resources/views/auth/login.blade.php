<x-guest-layout>
    <x-slot name="header">Giriş Yap</x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="/storage/img/logo.png" alt="{{ config('app.name') }}" class="w-24 mt-5">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="E-Posta" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Şifre" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Beni unutma</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        Şifreyi unuttuk iyi mi
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    Girişimi Yap
                </x-jet-button>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <div class="text-center pb-5">
            <a href="{{ route('register') }}"><x-jet-button class="ml-4">
                    Benim hesabım yok ki
                </x-jet-button></a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

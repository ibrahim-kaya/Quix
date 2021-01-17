<x-guest-layout>
    <x-slot name="header">Kayıt Ol</x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="/storage/img/logo.png" alt="QuiX" class="w-24 mt-5">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="Kullanıcı Adı" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="E-Posta" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Şifre" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="Şifre (bi' daha)" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __(':terms_of_servicenı ve :privacy_policynı okudum ve kabul ediyorum.', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">Kullanım Şartları</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">Gizlilik Politikası</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    Beni Üye Eyle
                </x-jet-button>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <div class="text-center pb-5">
            <a href="{{ route('login') }}"><x-jet-button class="ml-4">
                    Benim zaten hesabım var
        </x-jet-button></a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

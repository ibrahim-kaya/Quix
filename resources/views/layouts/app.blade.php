<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body class="font-sans antialiased">
<x-jet-banner />

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $header }}
            </h2>
        </div>
    </header>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg relative">
                @if($errors->any())
                    <div id="err" class="p-2 text-center transition duration-300">
                        <div class="inline-flex items-center bg-white leading-none bg-red-200 text-red-600 rounded-full p-2 shadow text-teal text-sm">
                            <span class="inline-flex bg-red-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-exclamation"></i></span>
                            <span class="inline-flex px-2">{!! $errors->first() !!}</span>
                            <span id ="err-kapat" class="inline-flex px-2 cursor-pointer">x</span>
                        </div>
                    </div>
                @endif
                @if(session('success'))
                    <div id="err" class="p-2 text-center transition duration-300">
                        <div class="inline-flex items-center bg-white leading-none bg-green-200 text-green-600 rounded-full p-2 shadow text-teal text-sm">
                            <span class="inline-flex bg-green-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-check"></i></span>
                            <span class="inline-flex px-2">{!! session('success') !!}</span>
                            <span id ="err-kapat" class="inline-flex px-2 cursor-pointer">x</span>
                        </div>
                    </div>
                @endif
                {{ $slot }}
                <footer class="mt-4 border-t py-3 text-xs text-gray-500 text-center leading-5">
                    <a href="">Hizmet Şartları</a> · <a href="">Gizlilik Politikası</a> · <a href="">Çerez Politikası</a><br>
                    <a href="">Twitter</a> · <a href="">Instagram</a> · <a href="">Facebook</a><br>
                    © 2021 Quix
                </footer>
            </div>
        </div>
    </div>


</div>

@stack('modals')

@livewireScripts


</body>

<script>
    $('#err-kapat').click(function (){
        $('#err').css('transform', 'scaleY(0)');
        $('#err').css('opacity', '0');
        setTimeout(
            function()
            {
                $('#err').hide();
            }, 300);
    });
</script>
</html>

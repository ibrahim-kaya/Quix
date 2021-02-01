<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header.' ~ Quix' }}</title>

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

<div class="min-h-screen bg-gray-100 bg-fixed" style="background-image: url(/storage/img/login-bg.png);">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    <header class="shadow" style="background-color:rgba(255, 255, 255, 0.65);">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $header }}
            </h2>
        </div>
    </header>

    <!-- Page Content -->
    @if($errors->any() || session('error'))
        <div class="err p-2 text-center transition duration-500 w-full absolute max-w-7xl mx-auto inset-x-0 -mt-1">
            <div class="flex justify-between items-center bg-white leading-none bg-red-200 text-red-600 rounded-md p-2 shadow text-sm">
                <span class="inline-flex bg-red-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-exclamation"></i></span>
                <span class="inline-flex px-2">@if($errors->any()) {!! $errors->first() !!} @else {!! session('error') !!} @endif</span>
                <span class="err-kapat inline-flex px-2 cursor-pointer">x</span>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="err p-2 text-center transition duration-500 w-full absolute max-w-7xl mx-auto inset-x-0 -mt-1">
            <div class="flex justify-between items-center bg-white leading-none bg-green-200 text-green-600 rounded-md p-2 shadow text-sm">
                <span class="inline-flex bg-green-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-check"></i></span>
                <span class="inline-flex px-2">{!! session('success') !!}</span>
                <span class="err-kapat inline-flex px-2 cursor-pointer">x</span>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg relative">
                {{ $slot }}
                <footer class="mt-4 border-t py-3 text-xs text-gray-500 text-center leading-5 bg-gray-100">
                    <a href="">Hizmet Şartları</a> · <a href="">Gizlilik Politikası</a> · <a href="">Katkıda Bulunanlar</a><br>
                    <a href="">Twitter</a> · <a href="">Instagram</a> · <a href="">Facebook</a><br>
                    © 2021 Quix
                </footer>
            </div>
        </div>
    </div>


</div>

@stack('modals')

@livewireScripts

<script>
    $('.err-kapat').click(function (){
        $('.err').css('transform', 'scale(0)');
        $('.err').css('opacity', '0');
        setTimeout(
            function()
            {
                $('.err').hide();
            }, 300);
    });

    $('#kategori-btn').click(function (){
        $('#kat').css("box-shadow", "0px 5px 15px 5px rgba(0,0,0,0.25)");
        $('#kategoriler').toggle( "slow", function() {
            if($("#kategoriler").is(":hidden")) $('#kat').css("box-shadow", "none");
        });
    });

    window.addEventListener('ModalAc', event => {
        $('#delete_modal_bg').css('visibility', 'visible');
        $('#delete_modal').css('visibility', 'visible');
        $('#delete_modal_body').css('transform', 'scaleY(1)');
        $('#delete_modal_bg').css('opacity', '.5');
        $('#delete_modal').css('opacity', '1');
        document.body.style.overflow = 'hidden';
    })

    window.addEventListener('ModalKapat', event => {

        $('.modal_body').css('transform', 'scaleY(0)');
        $('.modal_bg').css('opacity', '0');
        $('.modal').css('opacity', '0');

        setTimeout(function(){
            $('.modal_bg').css('visibility', 'hidden');
            $('.modal').css('visibility', 'hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    })

</script>
</body>


</html>

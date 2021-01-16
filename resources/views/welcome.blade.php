<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quix</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="antialiased">
<div class="flex flex-col justify-center items-center">
    <h1 class="text-2xl font-bold text-blue-500 my-20">Geçici Landing Page</h1>
    <a href="{{ route('login') }}"><button class="btn--primary my-2">Giriş Yap</button></a>
    <a href="{{ route('register') }}" ><button class="btn--primary my-2">Kayıt Ol</button></a>
    <a href="{{ route('quizler.index') }}" class="mt-5"><button class="btn--orange my-2">Quizleri Göreyim</button></a>
</div>
</body>
</html>

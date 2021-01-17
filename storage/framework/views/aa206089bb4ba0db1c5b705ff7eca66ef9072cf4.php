<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quix</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>

<body
    class="text-gray-700 bg-white"
    style="font-family: 'Source Sans Pro', sans-serif"
>
<!--Nav-->
<nav>
    <div
        class="container mx-auto px-6 py-2 flex justify-between items-center"
    >
        <a
            class="font-bold text-2xl lg:text-4xl"
            href="#"
        >
            <img src="/storage/img/logo.png" alt="" class="max-h-11">
        </a>

        <div>
            <a href="<?php echo e(route('login')); ?>"><button class="btn--primary">Giriş Yap</button></a>
            <a href="<?php echo e(route('register')); ?>"><button class="btn--orange">Kayıt Ol</button></a>
        </div>
    </div>
</nav>
<!--Hero-->
<div
    class="py-20"
    style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%)"
>
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-2 text-white">
            Her alandan çeşitli Quizler!
        </h2>
        <h3 class="text-2xl mb-8 text-gray-200">
            İlgini çeken her konuda çeşitli Quizler ile kendini test et!
        </h3>
        <a href="<?php echo e(route('quizler.index')); ?>"><button
            class="bg-white font-bold rounded-full py-4 px-8 shadow-lg uppercase tracking-wider"
        >
            Quizleri Gör
        </button></a>
    </div>
</div>
<!-- Features -->
<section class="container mx-auto px-6 p-10">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">
        Neler var?
    </h2>
    <div class="flex items-center flex-wrap mb-20">
        <div class="w-full md:w-1/2">
            <h4 class="text-3xl text-gray-800 font-bold mb-3">
                Kendi Quizini Oluştur!
            </h4>
            <p class="text-gray-600 mb-8">
                Önceden hazırlanıp koyulmuş Quizler sıkıcı mı geliyor? O zaman oyuna seni de dahil edelim! QuiX'de kendi
                Quizini oluşturup, ister arkadaşlarına özel yapabilir, istersen de herkese açık yapıp diğer
                kullanıcıların da
                çözmesini sağlayabilirsin!
            </p>
        </div>
        <div class="w-full md:w-1/2">
            <img src="/storage/img/landing_1.svg" alt="Quizini Oluştur!"/>
        </div>
    </div>
    <div class="flex items-center flex-wrap mb-20">
        <div class="w-full md:w-1/2">
            <img src="/storage/img/landing_2.svg" alt="Kategoriler"/>
        </div>
        <div class="w-full md:w-1/2 pl-10">
            <h4 class="text-3xl text-gray-800 font-bold mb-3">
                Onlarca Farklı Kategori
            </h4>
            <p class="text-gray-600 mb-8">
                Onlarca farklı kategori arasından ilgi alanına en uygun olanını seç ve o alanda hazırlanmış Quizler ile
                kendini test et!
            </p>
        </div>
    </div>
    <div class="flex items-center flex-wrap mb-20">
        <div class="w-full md:w-1/2">
            <h4 class="text-3xl text-gray-800 font-bold mb-3">
                Resimlerle Quizini Renklendir!
            </h4>
            <p class="text-gray-600 mb-8">
                Sadece yazılarla hazırlanmış Quizler sıkıcı mı geliyor? Bizce de öyle. O yüzden QuiX'de istersen
                sorularına görsel ekleyerek Quizini tekdüzelikten çıkarıp daha ilgi çekici hale getirebilirsin!
            </p>
        </div>
        <div class="w-full md:w-1/2">
            <img src="/storage/img/landing_3.png" alt="Resimli Quizler"/>
        </div>
    </div>
</section>

<footer class="mt-4 border-t py-3 text-xs text-gray-500 text-center leading-5 bg-gray-100">

    <a href="">Hizmet Şartları</a> · <a href="">Gizlilik Politikası</a> · <a href="">Çerez Politikası</a><br>
    <a href="">Twitter</a> · <a href="">Instagram</a> · <a href="">Facebook</a><br>
    <a href='https://www.freepik.com/'>İllustrasyonlar freepik.com'dan alınmıştır. - www.freepik.com</a><br>
    © 2021 Quix
</footer>


</body>
</html>
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/welcome.blade.php ENDPATH**/ ?>
 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quiz Yayınlandı! <?php $__env->endSlot(); ?>

    <div class="p-5">
    <h1 class="text-2xl font-bold text-green-600"><i class="fas fa-check"></i> Quizin başarıyla yayınlandı!</h1>
        <br>
    <p>Quiz'ini yayınladık. Şimdi arkana yaslanıp insanların Quiz'ine verdiği cevapları izleyebilirsin!</p><br>
        <?php if($quiz->gizlilik): ?>
            <p>Quiz'ini <b>liste dışı</b> olarak ayarladığın için insanlar onu kategori sayfalarında veya anasayfalarında göremezler. Aşağıdaki linki Quiz'ini çözmesini istediğin kişilere göndererek onlardan Quiz'ini çözmesini isteyebilirsin!</p>
            <br>
            <p>Quiz linki:</p>
            <input id="link" type="text" value="<?php echo e(route('quizler.show', $quiz->uniqueid)); ?>" class="w-full md:w-1/2 mb-2 rounded-md" readonly>
            <button class="btn--primary">Linki kopyala</button>
            <p id="msg" class="text-green-600" style="transition: all .4s; transform: scaleY(0)">Link Kopyalandı!</p>
            <br>
        <?php endif; ?>
        <a href="<?php echo e(route('anasayfa')); ?>"><button class="btn--primary"><i class="fas fa-home"></i> Anasayfaya Dön</button></a>
    </div>

    <script>
        $('button').click(function () {
            const copyText = document.getElementById("link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            $('#msg').css('transform', 'scaleY(1)');
        });
    </script>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/construct/yayinlandi.blade.php ENDPATH**/ ?>
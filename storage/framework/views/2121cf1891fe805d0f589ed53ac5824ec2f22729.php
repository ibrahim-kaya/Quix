<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($header.' ~ Quix'); ?></title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">

    <?php echo \Livewire\Livewire::styles(); ?>


    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
</head>
<body class="font-sans antialiased">
 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.banner','data' => []]); ?>
<?php $component->withName('jet-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 

<div class="min-h-screen bg-gray-100 bg-fixed" style="background-image: url(/storage/img/login-bg.png);">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-menu')->html();
} elseif ($_instance->childHasBeenRendered('lH9ZbJJ')) {
    $componentId = $_instance->getRenderedChildComponentId('lH9ZbJJ');
    $componentTag = $_instance->getRenderedChildComponentTagName('lH9ZbJJ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lH9ZbJJ');
} else {
    $response = \Livewire\Livewire::mount('navigation-menu');
    $html = $response->html();
    $_instance->logRenderedChild('lH9ZbJJ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <!-- Page Heading -->
    <header class="shadow" style="background-color:rgba(255, 255, 255, 0.65);">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e($header); ?>

            </h2>
        </div>
    </header>

    <!-- Page Content -->
    <?php if($errors->any() || session('error')): ?>
        <div class="err p-2 text-center transition duration-500 w-full absolute max-w-7xl mx-auto inset-x-0 -mt-1">
            <div class="flex justify-between items-center bg-white leading-none bg-red-200 text-red-600 rounded-md p-2 shadow text-sm">
                <span class="inline-flex bg-red-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-exclamation"></i></span>
                <span class="inline-flex px-2"><?php if($errors->any()): ?> <?php echo $errors->first(); ?> <?php else: ?> <?php echo session('error'); ?> <?php endif; ?></span>
                <span class="err-kapat inline-flex px-2 cursor-pointer">x</span>
            </div>
        </div>
    <?php endif; ?>
    <?php if(session('success')): ?>
        <div class="err p-2 text-center transition duration-500 w-full absolute max-w-7xl mx-auto inset-x-0 -mt-1">
            <div class="flex justify-between items-center bg-white leading-none bg-green-200 text-green-600 rounded-md p-2 shadow text-sm">
                <span class="inline-flex bg-green-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-check"></i></span>
                <span class="inline-flex px-2"><?php echo session('success'); ?></span>
                <span class="err-kapat inline-flex px-2 cursor-pointer">x</span>
            </div>
        </div>
    <?php endif; ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg relative">
                <?php echo e($slot); ?>

                <footer class="mt-4 border-t py-3 text-xs text-gray-500 text-center leading-5 bg-gray-100">
                    <a href="">Hizmet Şartları</a> · <a href="">Gizlilik Politikası</a> · <a href="">Katkıda Bulunanlar</a><br>
                    <a href="">Twitter</a> · <a href="">Instagram</a> · <a href="">Facebook</a><br>
                    © 2021 Quix
                </footer>
            </div>
        </div>
    </div>


</div>

<?php echo $__env->yieldPushContent('modals'); ?>

<?php echo \Livewire\Livewire::scripts(); ?>


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

        $('#delete_modal_body').css('transform', 'scaleY(0)');
        $('#delete_modal_bg').css('opacity', '0');
        $('#delete_modal').css('opacity', '0');

        setTimeout(function(){
            $('#delete_modal_bg').css('visibility', 'hidden');
            $('#delete_modal').css('visibility', 'hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    })

</script>
</body>


</html>
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/layouts/app.blade.php ENDPATH**/ ?>
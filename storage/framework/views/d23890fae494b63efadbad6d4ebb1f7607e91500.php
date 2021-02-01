 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quiz Soruları <?php $__env->endSlot(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sorular', ['quiz' => $quiz, 'kategori' => $kategori])->html();
} elseif ($_instance->childHasBeenRendered('jtwCMYd')) {
    $componentId = $_instance->getRenderedChildComponentId('jtwCMYd');
    $componentTag = $_instance->getRenderedChildComponentTagName('jtwCMYd');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('jtwCMYd');
} else {
    $response = \Livewire\Livewire::mount('sorular', ['quiz' => $quiz, 'kategori' => $kategori]);
    $html = $response->html();
    $_instance->logRenderedChild('jtwCMYd', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <script>

        window.addEventListener('oEditModal', event => {
            $('#edit_modal_bg').css('visibility', 'visible');
            $('#edit_modal').css('visibility', 'visible');
            $('#edit_modal_body').css('transform', 'scaleY(1)');
            $('#edit_modal_bg').css('opacity', '.5');
            $('#edit_modal').css('opacity', '1');
            document.body.style.overflow = 'hidden';
        })
    </script>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/construct/sorular.blade.php ENDPATH**/ ?>
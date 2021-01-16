 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quizlerim <?php $__env->endSlot(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('quizlerim')->html();
} elseif ($_instance->childHasBeenRendered('8JRBvi1')) {
    $componentId = $_instance->getRenderedChildComponentId('8JRBvi1');
    $componentTag = $_instance->getRenderedChildComponentTagName('8JRBvi1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('8JRBvi1');
} else {
    $response = \Livewire\Livewire::mount('quizlerim');
    $html = $response->html();
    $_instance->logRenderedChild('8JRBvi1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/quizlerim.blade.php ENDPATH**/ ?>
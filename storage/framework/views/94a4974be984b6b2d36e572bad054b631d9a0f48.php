<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('message', $exception->getMessage()); ?>

<?php echo $__env->make('errors::illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/errors/404.blade.php ENDPATH**/ ?>
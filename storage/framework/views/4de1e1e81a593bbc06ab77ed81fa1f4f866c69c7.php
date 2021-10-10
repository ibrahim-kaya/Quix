 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Anasayfa <?php $__env->endSlot(); ?>
    <div class="flex flex-row p-3 items-center bg-gray-50 border-b border-gray-200">
        <p class="text-lg"><img src="/storage/img/anasayfa.svg" alt="" class="w-7 h-7 mr-1 inline"><span
                class="font-bold align-middle">Akış</span></p>
    </div>


    <?php if($data['quizzes']->count()): ?>
        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            <?php $__currentLoopData = $data['quizzes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['uid']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
            <p class="text-gray-600">Takip ettiğin kategorilerdeki Quizler burada görünecek. </p>
            <p class="text-gray-600">Görünüşe göre henüz bir kategori takip etmiyorsun.</p><br>
            <p class="text-lg">Quizleri keşfet!</p>
            <a href="<?php echo e(route('quizler.index')); ?>">
                <button
                    type="button"
                    class="btn btn--primary mr-2 my-2">
                    <i class="fa fa-fire"></i> Popüler Quizler
                </button>
            </a>

            <p class="text-gray-600 my-5">-veya-</p>

            <p class="text-lg">Hemen bir Quiz oluştur!</p>
            <a href="<?php echo e(route('quizler.create')); ?>">
                <button
                    type="button"
                    class="btn btn--primary mr-2 my-2">
                    <i class="fa fa-plus"></i> Quiz Oluştur
                </button>
            </a>
        </div>
    <?php endif; ?>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/dashboard.blade.php ENDPATH**/ ?>
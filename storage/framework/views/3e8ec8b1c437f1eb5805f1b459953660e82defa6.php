 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quizler <?php $__env->endSlot(); ?>

    <div>
        <div class="flex justify-between bg-gray-200 border-b border-gray-300 py-2 shadow-inner">
            <div id="kat"
                 class="absolute ml-3 border bg-blue-100 border-blue-200 my-1 mr-3 py-1 px-3 rounded-md z-10 transition duration-500 max-w-3xl">
                <div>
                    <div id="kategori-btn" class="cursor-pointer">
                        <img src="https://www.flaticon.com/premium-icon/icons/svg/2735/2735293.svg" alt=""
                             class="w-9 h-9 inline-block">
                        <p class="inline">Kategoriler</p>
                    </div>
                    <div id="kategoriler" class="mt-5 hidden">

                        <div class="hidden lg:block">
                            <?php $__currentLoopData = $data['kategoriler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="/kategori/<?php echo e($kategori->link); ?>">
                                    <div class="kategori <?php echo e($kategori->renk); ?> inline-block"
                                         style="background-image: url(<?php echo e($kategori->icon); ?>);">
                                        <p><?php echo e($kategori->isim); ?></p>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="flex lg:hidden">
                            <div class="">
                                <?php $__currentLoopData = $data['kategoriler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->index % 2 == 0): ?>
                                        <a href="/kategori/<?php echo e($kategori->link); ?>">
                                            <div class="kategori <?php echo e($kategori->renk); ?>"
                                                 style="background-image: url(<?php echo e($kategori->icon); ?>);">
                                                <p><?php echo e($kategori->isim); ?></p>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="">
                                <?php $__currentLoopData = $data['kategoriler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->index % 2 != 0): ?>
                                        <a href="/kategori/<?php echo e($kategori->link); ?>">
                                            <div class="kategori <?php echo e($kategori->renk); ?>"
                                                 style="background-image: url(<?php echo e($kategori->icon); ?>);">
                                                <p><?php echo e($kategori->isim); ?></p>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div>
            </div>

            <div>
                <a href="<?php echo e(route('quizler.create')); ?>">
                    <button
                        type="button"
                        class="btn btn--primary mr-2 my-2">
                        <i class="fa fa-plus"></i> Yeni Oluştur
                    </button>
                </a>
            </div>
        </div>

        <?php if(isset($data['kategori'])): ?>
            <div
                class="flex flex-row p-3 items-center <?php if($data['quizzes']->count()): ?> bg-blue-100 <?php else: ?> bg-red-200 <?php endif; ?>">
                <?php if($data['quizzes']->count()): ?>
                    <p class="text-sm"><img src="<?php echo e($data['kategori']->icon); ?>" alt="" class="w-5 h-5 mr-1 inline"><span
                            class="font-bold"><?php echo e($data['kategori']->isim); ?></span>
                        kategorisinde <b><?php echo e($data['quizzes']->count()); ?></b> adet quiz bulundu</p>
            </div>
            <hr>
        <?php else: ?>
            <p class="text-sm"><img src="<?php echo e($data['kategori']->icon); ?>" alt="" class="w-5 h-5 mr-1 inline"><span
                    class="font-bold"><?php echo e($data['kategori']->isim); ?></span> kategorisinde hiç quiz bulunamadı!</p>
    </div>
    <hr>
    <?php endif; ?>

    <div class="flex flex-row p-2 items-center bg-gray-50 justify-between">
        <p class="text-lg"><img src="<?php echo e($data['kategori']->icon); ?>" alt="" class="w-7 h-7 mr-1 inline"><span
                class="font-bold align-middle ip5:text-sm"><?php echo e($data['kategori']->isim); ?></span></p>

        <form method="post" action="">
            <?php echo csrf_field(); ?>
            <?php if($data['takip']): ?>
                <button
                    class="rounded-md px-2 py-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-red-300 bg-red-200 hover:bg-red-400  ml-2">
                    <i class="fas fa-times text-red-600"></i> <span
                        class="ip5:text-sm">Bu kategoriyi takibi bırak</span>
                </button>
            <?php else: ?>
                <button
                    class="rounded-md px-2 py-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-gray-300 bg-gray-200 hover:bg-green-200  ml-2">
                    <i class="fas fa-heart text-red-600 text-xl"></i> <span
                        class="ip5:text-sm">Bu kategoriyi takip et</span>
                </button>
            <?php endif; ?>
        </form>
    </div>
    <hr>
    <?php else: ?>
        <div class="flex flex-row p-3 items-center bg-gray-50 border-b border-gray-200">
            <p class="text-lg"><img src="/storage/img/trending.svg" alt="" class="w-7 h-7 mr-1 inline"><span
                    class="font-bold align-middle">Popüler Quizler</span></p>
        </div>
    <?php endif; ?>



    <?php if(isset($data['kategori'])): ?>
        <?php if(!$data['quizzes'] -> count()): ?>
            <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
                <p class="text-gray-600">Bu kategoride henüz hiç quiz oluşturulmamış.</p><br>
                <p class="text-lg">İlk oluşturan sen ol!</p>
                <a href="<?php echo e(route('quizler.create')); ?>">
                    <button
                        type="button"
                        class="btn btn--primary mr-2 my-2">
                        <i class="fa fa-plus"></i> Quiz Oluştur
                    </button>
                </a>
            </div>
        <?php endif; ?>

        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            <?php $__currentLoopData = $data['quizzes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('quiz.templates.quiz-box', ['quiz' => $quiz, 'kategori' => $data['kategoriler']->where('link', $quiz->kategori)->first()->isim, 'userid' => $data['uid']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="flex flex-wrap mx-1 overflow-hidden pt-5">
            <?php $__currentLoopData = $qdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('quiz.templates.quiz-box', ['quiz' => $data['quizzes']->where('id', $q->id)->first(), 'kategori' => $data['kategoriler']->where('link', $data['quizzes']->where('id', $q->id)->first()->kategori)->first()->isim, 'userid' => $data['uid']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    <?php endif; ?>
    <div class="px-5 pb-5"><?php echo e($data['quizzes']->links()); ?></div>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/listele.blade.php ENDPATH**/ ?>
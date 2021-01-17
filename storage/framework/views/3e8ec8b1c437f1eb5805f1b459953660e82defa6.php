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
                                        <div class="kategori <?php echo e($kategori->renk); ?>inline-block"
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
            <div class="flex flex-row p-3 items-center <?php if($data['quizzes']->count()): ?> bg-blue-100 <?php else: ?> bg-red-200 <?php endif; ?>">
                <?php if($data['quizzes']->count()): ?>
                    <p><img src="<?php echo e($data['kategori']->icon); ?>" alt="" class="w-5 h-5 mr-1 inline"><span class="font-bold"><?php echo e($data['kategori']->isim); ?></span> kategorisinde <?php echo e($data['quizzes']->count()); ?> adet quiz bulundu</p>
            </div>
            <hr>
        <?php else: ?>
            <p><img src="<?php echo e($data['kategori']->icon); ?>" alt="" class="w-5 h-5 mr-1 inline"><span class="font-bold"><?php echo e($data['kategori']->isim); ?></span> kategorisinde hiç quiz bulunamadı!</p>
            </div>
            <hr>

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
        <?php else: ?>
        <div class="flex flex-row p-3 items-center bg-gray-50">
            <p class="text-lg"><img src="/storage/img/trending.svg" alt="" class="w-7 h-7 mr-1 inline"><span class="font-bold align-middle">Popüler quizler</span></p>
        </div>
        <hr>
        <?php endif; ?>

    <div class="flex flex-wrap mx-1 overflow-hidden pt-5">

        <?php $__currentLoopData = $data['quizzes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="my-2 pr-1 xl:pr-2 pl-1 w-full overflow-hidden xl:w-1/3 md:w-2/4 h-60">
                <div
                    class="relative bg-blue-50 hover:bg-blue-100 transition duration-300 border border-blue-200 h-full rounded-lg relative overflow-hidden shadow-md shadow-inner">
                    <?php if(\Illuminate\Support\Facades\Auth::check() && \App\Models\Cevap::where('userid', \Illuminate\Support\Facades\Auth::user()->id)->get()->where('soru_id', \App\Models\Soru::where('quiz_id', $quiz->id)->get()->first()->id)->count()): ?>
                        <div
                            class="bg-green-500 absolute right-0 py-1 px-2 rounded-md opacity-80 rounded-br-none rounded-tl-none text-white">
                            <i class="fas fa-check"></i> Çözüldü
                        </div>
                    <?php endif; ?>

                    <div class="flex justify-center h-32 overflow-hidden">
                        <a href="<?php echo e(route('quizler.show', $quiz->uniqueid)); ?>"><img
                                src="https://agentmajeur.fr/wp-content/uploads/femme-question-bleue-1.jpg"
                                alt="Quiz Resim" class="w-full"></a>
                    </div>
                    <a href="<?php echo e(route('quizler.show', $quiz->uniqueid)); ?>" class="p-3 yazi-kisalt"
                       title="<?php echo e($quiz->baslik); ?>"><?php echo e($quiz->baslik); ?></a><br>
                    <span class="px-3 py-2 text-xs text-gray-500 absolute bottom-0 mb-4">Oluşturan: <a href="#"
                                                                                            class="text-black"><?php echo e($quiz->getUser->name); ?></a>&nbsp;&nbsp;·
                        <span class="text-xs ml-1 text-gray-500">7 May 2021</span>
                        </span>

                        <span class="px-3 py-1 text-xs text-gray-500 absolute bottom-0">Kategori: <a href="/kategori/<?php echo e($quiz->kategori); ?>"
                                                                                                class="text-blue-500"><?php echo e($data['kategoriler']->where('link', $quiz->kategori)->first()->isim); ?></a>
                        </span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <div class="px-5 pb-5"><?php echo e($data['quizzes']->links()); ?></div>
    </div>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/listele.blade.php ENDPATH**/ ?>
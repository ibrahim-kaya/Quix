 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quiz <?php $__env->endSlot(); ?>
    <div class="m-5">
        <h1 class="text-xl font-bold"><?php echo e($data['quiz']->baslik); ?></h1>
        <br>
        <h1 class="text-lg"><?php echo e($data['quiz']->aciklama); ?></h1>
        <br>

        <?php if(\App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->count()): ?>
            <p>Çözüldüğü
                tarih: <?php echo e(\App\Models\Cevap::where('userid', $data['userid'])->get()->where('soru_id', \App\Models\Quiz::find($data['quiz']->id)->sorular->first()->id)->first()->created_at); ?></p>

            <a href="<?php echo e(route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid])); ?>">
                <button type="submit" class="btn btn--primary w-full lg:w-1/2 font-bold"><i
                        class="fas fa-check-circle"></i> Sonuçları Göster
                </button>
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('quiz.show', $data['quiz']->uniqueid)); ?>">
                <button class="btn btn--primary w-full lg:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Quize
                    Başla
                </button>
            </a>
        <?php endif; ?>

        <?php if(!Auth::check()): ?>
            <div class="mt-5">
                <p class="text-sm text-gray-600">Üye girişi yapmamışsın. Üye girişi yaparak çözdüğün soruların kaydedilmesini sağlayabilir, kendi
                    Quiz'lerini oluşturabilir, sana özel anasayfanda takip ettiğin konulardaki yeni Quiz'leri görebilirsin!</p>
                <p class="text-sm text-gray-600">Hemen şimdi üye olmak için <a href="<?php echo e(route('register')); ?>" class="text-blue-500">tıkla!</a></p>
            </div>
        <?php endif; ?>
    </div>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/onizleme.blade.php ENDPATH**/ ?>
 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quizler <?php $__env->endSlot(); ?>

    <div class="p-5 lg:p-10">
        <p class="text-2xl">Quiz: <b><?php echo e($data['quiz']->baslik); ?></b></p>
        <p class="mt-2"><?php echo nl2br(e($data['quiz']->aciklama)); ?></p>
        <br>
        <form method="post" action="<?php echo e(route('sonuc')); ?>">
            <?php echo csrf_field(); ?>
            <input hidden name="__id" value="<?php echo e($data['quiz']->id); ?>">
            <input hidden name="_id" value="<?php echo e($data['quiz']->uniqueid); ?>">
            <input hidden name="isim" value="<?php echo e($data['isim']); ?>">
            <?php $__currentLoopData = $data['sorular']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h1 class="text-lg pb-3 font-bold"><?php echo e($loop->index+1); ?>) <?php echo e($soru->soru); ?></h1>
                <input type="hidden" name="cevaplar[<?php echo e($loop->index); ?>][soru]" value="<?php echo e($soru->id); ?>">

                <?php if($soru->resim): ?>
                    <img src="<?php echo e($soru->resim); ?>" alt="" class="max-h-64 pb-3">
                <?php endif; ?>

                <input type="radio" id="cevap<?php echo e($soru->id); ?>-1" name="cevaplar[<?php echo e($loop->index); ?>][cevap]" class="hidden secenek" value="cevap1" <?php if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap1'): ?> checked <?php endif; ?>>
                <label for="cevap<?php echo e($soru->id); ?>-1"><span class="text-lg font-bold">a)</span> <?php echo e($soru->cevap1); ?></label><br>

                <input type="radio" id="cevap<?php echo e($soru->id); ?>-2" name="cevaplar[<?php echo e($loop->index); ?>][cevap]" class="hidden secenek" value="cevap2" <?php if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap2'): ?> checked <?php endif; ?>>
                <label for="cevap<?php echo e($soru->id); ?>-2"><span class="text-lg font-bold">b)</span> <?php echo e($soru->cevap2); ?></label><br>

                <?php if($soru->cevap3): ?> <input type="radio" id="cevap<?php echo e($soru->id); ?>-3" name="cevaplar[<?php echo e($loop->index); ?>][cevap]" class="hidden secenek" value="cevap3" <?php if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap3'): ?> checked <?php endif; ?>>
                <label for="cevap<?php echo e($soru->id); ?>-3"><span class="text-lg font-bold">c)</span> <?php echo e($soru->cevap3); ?></label><br> <?php endif; ?>

                <?php if($soru->cevap4): ?> <input type="radio" id="cevap<?php echo e($soru->id); ?>-4" name="cevaplar[<?php echo e($loop->index); ?>][cevap]" class="hidden secenek" value="cevap4" <?php if(old('cevaplar.'. $loop->index .'.cevap') == 'cevap4'): ?> checked <?php endif; ?>>
                <label for="cevap<?php echo e($soru->id); ?>-4"><span class="text-lg font-bold">d)</span> <?php echo e($soru->cevap4); ?></label><br> <?php endif; ?>

                <br><?php if($loop->index < $loop->count - 1): ?> <hr><br> <?php endif; ?>

                <?php
                /*$value = $data['sorular']->where('id', '=', '60');
                <p>5. sorunun cevabı: {{ $value->first()->dogru_cevap }}</p>*/
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <button type="submit" class="btn btn--primary w-full lg:w-1/2 font-bold"><i class="fas fa-check-circle"></i> Sonucumu Göster</button>
        </form>
    </div>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/quiz.blade.php ENDPATH**/ ?>
 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quiz Oluştur <?php $__env->endSlot(); ?>

    <form method="POST" action="<?php echo e(route('quizler.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="px-5 py-5">
            <div class="flex flex-col text-sm">
                <label class="font-bold mb-2">Quiz Başlığı</label>
                <input class=" appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500" type="text" name="baslik" placeholder="Bir başlık yazın" value="<?php echo e(old('baslik')); ?>">
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Açıklaması (Opsiyonel)</label>
                <textarea name="aciklama" class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500" placeholder="Bir açıklama yazın..."><?php echo e(old('aciklama')); ?></textarea>
            </div>

            <div class="flex flex-col text-sm">
                <label class="font-bold mt-4 mb-2">Quiz Görseli (Opsiyonel)</label>
                <input type="file" class="rounded-md w-full" name="resim">
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Kategorisi</label>
                <select name="kategori" class=" appearance-none w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">
                    <option value="" selected disabled>Bir kategori seçin...</option>
                    <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kategori->link); ?>"><?php echo e($kategori->isim); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="text-sm flex flex-col">
                <label class="font-bold mt-4 mb-2">Quiz Gizliliği</label>
                <select name="gizlilik"
                        class=" appearance-none w-full border border-gray-200 p-2 focus:outline-none focus:border-gray-500">
                    <option value="0">Herkese açık</option>
                    <option value="1">Liste dışı (Sadece linke tıklayarak
                        ulaşılabilinsin)
                    </option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn--primary mb-5 ml-5">Quiz Oluştur</button>
    </form>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/olustur.blade.php ENDPATH**/ ?>
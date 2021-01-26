 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" href="/css/rate.css">

    <div class="p-5 lg:p-10">
        <div class="p-5 pb-2 mb-10 bg-gray-200 border border-gray-300 shadow rounded-md">
            <h1 class="text-2xl sm:text-3xl font-bold text-green-600 mb-5 text-center">!! Quiz Sonuçları !!</h1>

            <h1 class="text-xl">Quiz:
                <spa class="font-bold"><?php echo e($data['quiz']->baslik); ?></span>
            </h1>
            <br>

            <p>Çözen:</p>

            <?php echo $__env->make('quiz.templates.user-card', ['user' => $data['user'], 'bg' => 'bg-gray-300', 'border' => 'border-gray-400'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php
            $dogru = 0;
            foreach ($data['sorular'] as $soru) {
                if ($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap) $dogru++;
            }
            ?>

             <?php $__env->slot('header'); ?> <?php echo e($data['user']->name); ?>

                Quiz Sonucu ~ <?php echo e($dogru); ?>/<?php echo e($data['sorular']->count()); ?> <?php $__env->endSlot(); ?>

            <p class="mt-5">Sonuçlar:</p>
            <p class="font-bold text-green-600"><i class="fas fa-check"></i> Doğru Cevap Sayısı: <span
                    class="text-lg"><?php echo e($dogru); ?></span></p>
            <p class="font-bold text-red-600"><i class="fas fa-times"></i> Yanlış Cevap Sayısı: <span
                    class="text-lg"><?php echo e($data['sorular']->count() - $dogru); ?></span></p>
            <br>
            <?php if((\Illuminate\Support\Facades\Auth::check() && $data['userid'] == \Illuminate\Support\Facades\Auth::id()) || $data['userid'] == 'u'.\Illuminate\Support\Facades\Session::getId()): ?>
                <br>
                <p>Sonucunu paylaş:</p>
                <input id="link" type="text"
                       value="<?php echo e(route('sonuc_Goster', [$data['userid'], $data['quiz']->uniqueid])); ?>"
                       class="w-full md:w-1/2 mb-2 rounded-md" readonly>
                <button id="kopyala" class="btn--primary">Linki kopyala</button>
                <p id="msg" class="text-green-600" style="transition: all .4s; transform: scaleY(0)">Link
                    Kopyalandı!</p>


            <?php if($data['puan']->count()): ?>
                <div><p>Bu Quiz'e <?php echo e($data['puan']->first()->puan); ?> puan verdin.</p>
                    <div class="Stars " style="--rating: <?php echo e($data['puan']->first()->puan); ?>;"
                         aria-label="Bu Quiz'e 5 üzerinden <?php echo e($data['puan']->first()->puan); ?> puan verdin.">
                    </div>
                </div>
            <?php else: ?>
                <form method="post" action="<?php echo e(url('oyla')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="uid" value="<?php echo e($data['userid']); ?>">
                    <input type="hidden" name="_id" value="<?php echo e($data['quiz']->uniqueid); ?>">
                    <div
                        class="flex flex-wrap items-center flex-col sm:flex-row sm:w-max border-t border-b sm:border-t-0 sm:border-b-0 border-gray-300 py-3">
                        <p>Bu Quiz'i oyla:</p>
                        <div class="w-full"></div>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="puan" value="5"/><label class="full" for="star5"
                                                                                         title="Çok iyi - 5 yıldız"></label>
                            <input type="radio" id="star4" name="puan" value="4"/><label class="full" for="star4"
                                                                                         title="Fena değil - 4 yıldız"></label>
                            <input type="radio" id="star3" name="puan" value="3"/><label class="full" for="star3"
                                                                                         title="Eh işte - 3 yıldız"></label>
                            <input type="radio" id="star2" name="puan" value="2"/><label class="full" for="star2"
                                                                                         title="Pek beğenmedim - 2 yıldız"></label>
                            <input type="radio" id="star1" name="puan" value="1"/><label class="full" for="star1"
                                                                                         title="Hiç beğenmedim - 1 yıldız"></label>
                        </fieldset>
                        <button
                            class="rounded-md px-2 py-1 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-green-500 bg-green-500 text-white hover:bg-green-600 ml-3">
                            Oyla
                        </button>
                    </div>
                </form>
            <?php endif; ?>
            <?php endif; ?>


            <?php if(!\Illuminate\Support\Facades\Auth::check()): ?>
                <br>
                <p class="text-sm text-gray-600">Sen de kendi Quiz'ini oluşturmak istiyorsan hemen <a
                        href="<?php echo e(route('register')); ?>" class="text-blue-500">kaydol!</a></p>
            <?php endif; ?>
        </div>
        <hr>
        <br>

        <?php $__currentLoopData = $data['sorular']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h1 class="text-lg pb-3 font-bold"><?php echo e($loop->index+1); ?>) <?php echo e($soru->soru); ?>

                <?php if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == $soru->dogru_cevap): ?>
                    <div
                        class="inline-block bg-green-500 border border-green-700 text-green-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm">
                        <i class="fas fa-check"></i> Doğru cevap!
                    </div>
                <?php else: ?>
                    <div
                        class="inline-block bg-red-500 border border-red-700 text-red-200 rounded-2xl rounded-tl-none px-2 py-1 text-sm">
                        <i class="fas fa-times"></i> Yanlış cevap
                    </div>
                <?php endif; ?>
            </h1>

            <?php if($soru->resim): ?>
                <img src="<?php echo e($soru->resim); ?>" alt="" class="max-h-64 pb-3">
            <?php endif; ?>

            <p class="secenek-box <?php if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap1'): ?> secilen <?php endif; ?> <?php if($soru->dogru_cevap == 'cevap1'): ?> dogru <?php endif; ?>">
                a) <?php echo e($soru->cevap1); ?></p>
            <p class="secenek-box <?php if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap2'): ?> secilen <?php endif; ?> <?php if($soru->dogru_cevap == 'cevap2'): ?> dogru <?php endif; ?>">
                b) <?php echo e($soru->cevap2); ?></p>
            <p class="secenek-box <?php if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap3'): ?> secilen <?php endif; ?> <?php if($soru->dogru_cevap == 'cevap3'): ?> dogru <?php endif; ?>">
                c) <?php echo e($soru->cevap3); ?></p>
            <p class="secenek-box <?php if($data['cevaplar']->where('soru_id', $soru->id)->first()->cevap == 'cevap4'): ?> secilen <?php endif; ?> <?php if($soru->dogru_cevap == 'cevap4'): ?> dogru <?php endif; ?>">
                d) <?php echo e($soru->cevap4); ?></p>
            <br><br>
            <hr><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script>
        $('#kopyala').click(function () {
            const copyText = document.getElementById("link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            $('#msg').css('transform', 'scaleY(1)');
            setTimeout(function () {
                $('#msg').css('transform', 'scaleY(0)');
            }, 5000);
        });
    </script>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/sonuc.blade.php ENDPATH**/ ?>
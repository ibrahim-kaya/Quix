 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> Quiz Soruları <?php $__env->endSlot(); ?>
    <?php
        $gzlilik = ['Herkese Açık', 'Liste Dışı (Sadece link ile ulaşılabilinir)'];
    ?>

    <div id="hatavar" class="hidden"><?php
        if($errors->any() && ($errors->has('cevap1') || $errors->has('cevap2') || $errors->has('cevap3') || $errors->has('cevap4') || $errors->has('dogru_cevap') || $errors->has('resim'))) echo '1';
        ?></div>

    <div class="flex justify-between border-b bg-gray-200 border-gray-300">
        <div class="border-r border-green-300"><a href="<?php echo e(route('quizler.edit', $quiz->uniqueid)); ?>"><p
                    class="hover:bg-gray-300 py-3 px-5 font-bold" style="transition: all .4s;"><i
                        class="fas fa-chevron-left"></i> Geri</p></a></div>
        <div class="flex items-center">
            <div>
                <button id="yeni" class="btn btn--primary mr-2 text-sm sm:text-base"><i class="fas fa-plus"></i> Yeni Soru</button>
            </div>
            <div>
                <button id="bitir" class="btn btn--primary mr-2 text-sm sm:text-base"><i class="fas fa-check-circle"></i> Bitir</button>
            </div>
        </div>
    </div>

    <p class="p-3 text-sm text-gray-600">Quiz'ine soru eklemek için yukarıdaki "<b class="text-green-600">Yeni Soru</b>"
        butonuna basabilirsin. Tüm soruların hazır olduğunda bitirip Quiz'ini yayınlamak için yukarıdaki "<b
            class="text-green-600">Bitir</b>" butonuna bas! Eğer yayınlamak istemiyor, taslak olarak kalmasını
        istiyorsan soruları ekledikten sonra bu sayfayı kapatabilirsin. Soruların kaydediliyor.</p>

    <div class="p-5 lg:p-10">
        <p class="text-2xl">Quiz: <b><?php echo e($quiz->baslik); ?></b></p>
        <br>

        <input hidden name="__id" value="<?php echo e($quiz->id); ?>">
        <input hidden name="_id" value="<?php echo e($quiz->uniqueid); ?>">

        <?php if(!$quiz->sorular->count()): ?>
            <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
                <p class="text-gray-600">Bu Quiz'e henüz hiç soru eklenmemiş.</p><br>
                <p class="text-lg">Yukarıdaki '<span class="text-green-600">Yeni Soru</span>' butonuyla hemen bir soru ekleyebilirsin!</p>
            </div>
        <?php endif; ?>

        <?php $__currentLoopData = $quiz->sorular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center pb-3">

                <h1 class="text-lg font-bold"><button
                        class="inline rounded-md px-2 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-red-500 bg-red-500 text-white hover:bg-red-600 mr-1"
                        onclick="soruSil(<?php echo e($soru->id); ?>)"><i class="fas fa-trash"></i>
                    </button> <?php echo e($loop->index+1); ?>) <?php echo e($soru->soru); ?></h1></div>
            <input type="hidden" name="cevaplar[<?php echo e($loop->index); ?>][soru]" value="<?php echo e($soru->id); ?>">

            <?php if($soru->resim): ?>
                <img src="<?php echo e($soru->resim); ?>" alt="" class="max-h-64 pb-3">
            <?php endif; ?>

            <p class="secenek-box <?php if($soru->dogru_cevap == 'cevap1'): ?> dogru <?php endif; ?>">a) <?php echo e($soru->cevap1); ?></p>
            <p class="secenek-box <?php if($soru->dogru_cevap == 'cevap2'): ?> dogru <?php endif; ?>">b) <?php echo e($soru->cevap2); ?></p>
            <p class="secenek-box <?php if($soru->dogru_cevap == 'cevap3'): ?> dogru <?php endif; ?>">c) <?php echo e($soru->cevap3); ?></p>
            <p class="secenek-box <?php if($soru->dogru_cevap == 'cevap4'): ?> dogru <?php endif; ?>">d) <?php echo e($soru->cevap4); ?></p>
            <br>

            <br><?php if($loop->index < $loop->count - 1): ?>
                <hr><br> <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


    <div id="modal_bg" class="fixed left-0 bottom-0 w-full h-full bg-gray-800 transition opacity-50 invisible"
         style="transition: all .3s;">
    </div>
    <div id="modal" class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full transition invisible"
         style="transition: all .3s;">
        <div id="modal_body" class="bg-white md:rounded-lg w-full md:w-2/3 xl:w-1/2 transition mb-30"
             style="transition: all .3s; transform: scaleY(0)">
            <div class="flex flex-col p-4">
                <div class="flex items-center w-full pb-2">
                    <div id="modal_baslik" class="text-gray-900 font-medium text-lg font-bold">Soru Ekle</div>
                    <svg class="modal-kapat ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                <hr>
                <?php if($errors->any() || session('error')): ?>
                    <div class="err p-2 text-center transition duration-500 w-full">
                        <div class="inline-flex items-center bg-white leading-none bg-red-200 text-red-600 rounded-full p-2 shadow text-sm">
                            <span class="inline-flex bg-red-600 text-white rounded-full h-6 px-3 justify-center items-center"><i class="fas fa-exclamation"></i></span>
                            <span class="inline-flex px-2"><?php if($errors->any()): ?> <?php echo $errors->first(); ?> <?php else: ?> <?php echo session('error'); ?> <?php endif; ?></span>
                            <span class="err-kapat inline-flex px-2 cursor-pointer">x</span>
                        </div>
                    </div>
                <?php endif; ?>
                <div id="modal_icerik" class="">[null]</div>
                <hr>
                <div class="ml-auto mt-5">
                    <button
                        class="modal-kapat transition focus:outline-none bg-transparent hover:bg-gray-300 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
                        Vazgeçtim
                    </button>
                    <a href="#" id="link">
                        <button id="btn_onay" class="btn--primary">
                            Ekle
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>

        $('#yeni').click(function () {
            var html = `
                          <div class="px-5 py-3 max-h-96 md:max-h-full overflow-y-scroll md:overflow-hidden">
                            <div class="">
                             <form id="soru_ekle" method="post" action="" class="flex flex-col" enctype="multipart/form-data">
                             <?php echo csrf_field(); ?>
                            <label><b>Soruyu yaz:</b></label><br>
                             <textarea class="rounded-md mb-4" name="soru"> <?php echo e(old('soru')); ?></textarea><br><br>
                             <label><b>Soru resmi (opsiyonel):</b></label><br>
                              <input type="file" class="rounded-md w-full" name="resim">
                              <div class="flex flex-col lg:flex-row mt-4">
                              <div class="w-full lg:w-1/2 lg:pr-5">
                            <label><b>A şıkkı:</b></label><br>
                              <input type="text" name="cevap1" class="rounded-md w-full" value="<?php echo e(old('cevap1')); ?>">
                              <div class="mb-4"><input id="a" type="radio" name="dogru_cevap" value="cevap1 <?php if(old('dogru_cevap') === "cevap1"): ?> checked <?php endif; ?>"><label for="a" class="text-sm">Doğru Şık</label></div>
                            <label><b>B şıkkı:</b></label><br>
                              <input type="text" name="cevap2" class="rounded-md w-full" value="<?php echo e(old('cevap2')); ?>">
                              <div class="mb-4"><input id="b" type="radio" name="dogru_cevap" value="cevap2 <?php if(old('dogru_cevap') === "cevap2"): ?> checked <?php endif; ?>"><label for="b" class="text-sm">Doğru Şık</label></div>
                            </div>
                            <div class="w-full lg:w-1/2">
                            <label><b>C şıkkı:</b></label><br>
                              <input type="text" name="cevap3" class="rounded-md w-full" value="<?php echo e(old('cevap3')); ?>">
                              <div class="mb-4"><input id="c" type="radio" name="dogru_cevap" value="cevap3 <?php if(old('dogru_cevap') === "cevap3"): ?> checked <?php endif; ?>"><label for="c" class="text-sm">Doğru Şık</label></div>
                            <label><b>D şıkkı:</b></label><br>
                               <input type="text" name="cevap4" class="rounded-md w-full" value="<?php echo e(old('cevap4')); ?>">
                               <div class="mb-4"><input id="d" type="radio" name="dogru_cevap" value="cevap4" <?php if(old('dogru_cevap') === "cevap4"): ?> checked <?php endif; ?>><label for="d" class="text-sm">Doğru Şık</label></div>
                            </div>
                            </div>
                            </form>
                            </div>
                          </div>
                        `;

            $('#modal_baslik').html('Soru Ekle');
            $('#modal_icerik').html(html);
            $('#link').attr("href", "#");
            $('#btn_onay').attr("type", "submit");
            $('#btn_onay').attr("form", "soru_ekle");
            $('#btn_onay').toggleClass().addClass('btn--primary');
            $('#btn_onay').html('Ekle');
            modal_ac();
        });

        $('#bitir').click(function () {

            const html = `
                          <form id="bitir_form" method="post" action="<?php echo e(route('yayinlandi')); ?>">
                          <input type="hidden" name="quiz" value="<?php echo e($quiz->uniqueid); ?>">
                          <?php echo csrf_field(); ?>
                          <div class="py-10 sm:px-5">
                            <p class="text-lg">Soru eklemeyi bitirip Quiz'ini yayınlamak istiyor musun?</p>
                            <p class="text-gray-600">Quiz'in yayınlandıktan sonra onu tekrar düzenleyemezsin.</p>
                            <p class="text-gray-600">Taslak olarak bırakmak istiyorsan sayfayı kapatıp çıkabilirsin. Soruların otomatik kaydediliyor.</p>
                            <br>
                            <hr>
                            <br>
                            <p>Quizin <b><?php echo e($gzlilik[$quiz->gizlilik]); ?></b> olarak <b class="text-green-600"><?php echo e($quiz->sorular->count()); ?> soru</b> ile birlikte yayınlanacak.</p>
                          </div>
                          </form>
                        `;

            $('#modal_baslik').html('Bitir ve Yayınla');
            $('#modal_icerik').html(html);
            $('#link').attr("href", "#");
            $('#btn_onay').attr("type", "submit");
            $('#btn_onay').attr("form", "bitir_form");
            $('#btn_onay').toggleClass().addClass('btn--primary');
            $('#btn_onay').html('Yayınla Gitsin');
            modal_ac();
        });

        $('.modal-kapat').click(function () {
            modal_kapat();
        });

        function modal_ac() {
            $('#modal_bg').css('visibility', 'visible');
            $('#modal').css('visibility', 'visible');
            $('#modal_body').css('transform', 'scaleY(1)');
            $('#modal_bg').css('opacity', '.5');
            $('#modal').css('opacity', '1');
            document.body.style.overflow = 'hidden';
        }

        function modal_kapat() {
            $('#modal_body').css('transform', 'scaleY(0)');
            $('#modal_bg').css('opacity', '0');
            $('#modal').css('opacity', '0');

            setTimeout(function () {
                $('#modal_bg').css('visibility', 'hidden');
                $('#modal').css('visibility', 'hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function soruSil(id) {
            $('#modal_baslik').html('Soru Sil');
            $('#modal_icerik').html('<div class="py-10">Bu soruyu silmek istediğine emin misin?</div>');
            $('#link').attr("href", "sorular/" + id + "/sil");
            $('#btn_onay').toggleClass().addClass('btn--red');
            $('#btn_onay').html('Sil Gitsin');
            modal_ac();
        }

        $( document ).ready(function() {
            if($('#hatavar').html() == '1')
            {
                $( "#yeni" ).click();
            }
        });

    </script>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/quiz/construct/sorular.blade.php ENDPATH**/ ?>
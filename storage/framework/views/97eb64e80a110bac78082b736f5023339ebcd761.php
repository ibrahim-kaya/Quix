<div>
    <div>
        <?php if($data['quizzes']->count()): ?>
            <table class="min-w-full leading-normal quiz-table mb-5 border-t border-gray-200">
                <thead class="hidden md:table-header-group">
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Quiz
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Oluşturma Tarihi
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Durum
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        İşlemler
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php $__currentLoopData = $data['quizzes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="relative px-5 pt-7 pb-12 lg:pb-5 border-b border-gray-300 md:border-gray-200 text-sm quiz-table-baslik cursor-pointer max-w-sm shadow md:shadow-none">
                            <p class="text-gray-900 whitespace-no-wrap text-lg"><?php echo e($quiz->baslik); ?></p>
                            <div class="quiz-table-info flex items-center justify-between mt-6 py-1 px-3 bg-gray-50 absolute bottom-0 right-0 w-full rounded-t-md border-t border-gray-300">
                                <div>
                                    <span class="relative inline-block px-3 py-0.5 font-semibold text-green-900 leading-tight mx-1.5">
                                        <span class="absolute inset-0 bg-<?php echo e(($quiz->durum ? 'green' : 'yellow')); ?>-500 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs"><i class="fas <?php echo e(($quiz->durum ? 'fa-check' : 'fa-pencil-ruler')); ?>"></i> <?php echo e($data['durumtxt'][$quiz->durum]); ?>  </span>
                                    </span>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('quizler.show', $quiz->uniqueid)); ?>" title="Görüntüle"><button class="rounded-md px-2 py-1 ml-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-yellow-500 bg-yellow-500 text-white hover:bg-yellow-600;"><i class="fa fa-file-alt"></i></button></a>
                                    <a href="<?php echo e(route('quizler.edit', $quiz->uniqueid)); ?>" title="Düzenle"><button class="rounded-md px-2 py-1 ml-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-green-500 bg-green-500 text-white hover:bg-green-600;"><i class="fa fa-edit"></i></button></a>
                                    <button wire:click="quizSil('<?php echo e($quiz->uniqueid); ?>')" class="rounded-md px-2 py-1 ml-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-red-500 bg-red-500 text-white hover:bg-red-600" title="Sil"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Jan 21, 2020
                            </p>
                        </td>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        <span aria-hidden class="absolute inset-0 bg-<?php echo e(($quiz->durum ? 'green' : 'yellow')); ?>-500 opacity-50 rounded-full"></span>
                        <span class="relative"><i class="fas <?php echo e(($quiz->durum ? 'fa-check' : 'fa-pencil-ruler')); ?>"></i> <?php echo e($data['durumtxt'][$quiz->durum]); ?></span>
                    </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex justify-end">
                            <a href="<?php echo e(route('quizler.show', $quiz->uniqueid)); ?>" class="ml-1" title="Görüntüle"><button class="btn btn--orange"><i class="fa fa-file-alt"></i></button></a>
                            <a href="<?php echo e(route('quizler.edit', $quiz->uniqueid)); ?>" class="ml-1  " title="Düzenle"><button class="btn btn--primary"><i class="fa fa-edit"></i></button></a>
                            <button wire:click="quizSil('<?php echo e($quiz->uniqueid); ?>')" class="ml-1 btn btn--red" title="Sil"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="p-5 text-center bg-gray-200 m-5 rounded-lg border border-gray-300 shadow-inner">
                        <p class="text-gray-600">Henüz hiç quiz oluşturmamışsın.</p><br>
                        <p class="text-lg">Hemen şimdi bir quiz oluştur!</p>
                        <a href="<?php echo e(route('quizler.create')); ?>"><button
                                type="button"
                                class="btn btn--primary mr-2 my-2">
                                <i class="fa fa-plus"></i> Quiz Oluştur
                            </button></a>
                    </div>
                <?php endif; ?>
                </tbody>
            </table>
            <div class="px-5 mb-5"><?php echo e($data['quizzes']->links()); ?></div>
            <div class="quiz-table-info text-center pb-5">
                <span class="text-xs text-gray-500">Sayfa: <?php echo e($data['quizzes']->currentPage().'/'.$data['quizzes']->lastPage()); ?></span>
            </div>
    </div>


    <div id="delete_modal_bg" class="fixed left-0 bottom-0 w-full h-full bg-gray-800 transition opacity-50 invisible" style="transition: all .3s;">
    </div>
    <div id="delete_modal" class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full transition invisible" style="transition: all .3s;">
        <div id="delete_modal_body" class="bg-white md:rounded-lg w-full md:w-1/2 transition mb-30" style="transition: all .3s; transform: scaleY(0)">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full">
                    <div class="text-gray-900 font-medium text-lg font-bold">Quiz Sil</div>
                    <svg wire:click="kapat" class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                <hr>
                <div class="mt-5"><b class="text-red-500"><?php if($data['quizzes']->find($selectedQuiz)): ?> <?php echo e($data['quizzes']->find($selectedQuiz)->baslik); ?> <?php endif; ?></b> başlıklı quizi silmek istediğine emin misin?</div>
                <hr>
                <div class="ml-auto mt-5">
                    <button wire:click="kapat" class="transition focus:outline-none bg-transparent hover:bg-gray-300 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
                        Vazgeçtim
                    </button>
                    <button wire:click="quiziSil" class="transition focus:outline-none bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Aynen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/livewire/quizlerim.blade.php ENDPATH**/ ?>
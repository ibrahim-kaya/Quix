<div>
    <div id="delete_modal_bg" class="fixed left-0 bottom-0 w-full h-full bg-gray-800 transition opacity-0 invisible">
    </div>
    <div id="delete_modal" class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full transition opacity-0 invisible">
        <div id="delete_modal_body" class="bg-white md:rounded-lg w-full md:w-1/2 transition mb-30" style="transform: scaleY(0)">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full">
                    <div class="text-gray-900 font-medium text-lg">Quiz Sil</div>
                    <svg class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                <hr>
                <div class="mt-5">ID'li Quizi silek mi?</div>
                <hr>
                <div class="ml-auto mt-5">
                    <button wire:click="kapat" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Agree
                    </button>
                    <button class="bg-transparent hover:bg-gray-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\XpDeviL\Desktop\Projeler\LaravelQuiz\resources\views/livewire/modal-wire.blade.php ENDPATH**/ ?>
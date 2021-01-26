<x-jet-action-section>
    <x-slot name="title">
        {{ __('Hesabı Sil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Hesabı kalıcı olarak sil.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Hesabın silindiğinde eklediğin Quizler silinmez. Eğer Quizlerin de silinsin istiyorsan önce Quizlerini silip sonra hesabını silmen gerek. Bu işlemin geri dönüşü de yok bu arada. İyi düşün.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Hesabı Sil') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Hesabı Sil') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Hesabın silindiğinde eklediğin Quizler silinmez. Eğer Quizlerin de silinsin istiyorsan önce Quizlerini silip sonra hesabını silmen gerek. Bu işlemin geri dönüşü de yok bu arada. Eğer kararını verdiysen hesabı silmek için şifreni aşağıya yaz.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Vazgeçtim') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Hesabı Sil') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>

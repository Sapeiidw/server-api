<x-jet-action-section>
    <x-slot name="title">
        <x-title value="{{ __('Hapus akun') }}"/>
    </x-slot>

    <x-slot name="description">
        <div class="px-2 text-gray-600 ">
            <x-text value="{{ __('Hapus akun Anda secara permanen.') }}"/>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="w-full text-sm text-gray-600">
            <x-text value="{{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}"/>
        </div>

        <div class="flex justify-end mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Hapus akun') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <div class=" items-center justify-center">
            <x-jet-dialog-modal wire:model="confirmingUserDeletion">
                <div class=" justify-end">
                    <x-slot name="title">
                        <x-title value="{{ __('Hapus akun') }}"/>
                    </x-slot>
                </div>


                <x-slot name="content">
                    <x-text value="{{ __('Apakah Anda yakin ingin menghapus akun Anda? Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}"/>

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
                        {{ __('Batal') }}
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('Hapus akun') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        </div>

    </x-slot>
</x-jet-action-section>

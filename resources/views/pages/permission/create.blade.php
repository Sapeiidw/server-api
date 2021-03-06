<x-admin-layout>
    @section('title', 'Create Permission')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">
                <form method="POST" action="{{ route('permission.store') }}">
                    @csrf
                    <div class="mt-4">
                        <x-jet-input placeholder="Nama Permission"
                        class="block w-full border rounded-3xl dark:text-white dark:bg-gray-700 dark:border-gray-900 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                        type="text" name="name" :value="old('name')"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="modal-open ml-4 ">
                            {{ __('Tambahkan') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

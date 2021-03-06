<x-admin-layout>
    @section('title', 'Create Role')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">
                <form method="POST" action="{{ route('role.store') }}">
                    @csrf

                    <div class="mt-4">
                        <x-jet-input placeholder="Nama Role" class="block w-full dark:bg-gray-700 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                        type="text" name="name" :value="old('name')"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex  items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Tambahkan') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

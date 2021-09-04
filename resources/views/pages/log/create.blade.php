<x-admin-layout>
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client > Create') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">

                <x-alert></x-alert>

                <form enctype="multipart/form-data" method="POST" action="{{ route('client.store') }}">
                    @csrf
                    <div class="mt-4">
                        <x-jet-label for="name" value="Name" />
                        <x-jet-input class="block w-full mt-1" type="text" name="name" :value="old('name')"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="link" value="Link" />
                        <x-jet-input class="block w-full mt-1" type="url" name="link" :value="old('link')"/>
                        @error('link')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="photo" value="Photo" />
                        {{-- <input class="block w-full mt-1" type="file" name="photo"/> --}}
                        <input type="file" name="photo" id="">
                        @error('photo')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="modal-open ml-4" type="submit">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

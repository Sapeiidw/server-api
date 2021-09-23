<x-admin-layout>
    @section('title', 'Create Client')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 pt-2 pb-8">
                <form enctype="multipart/form-data" method="POST" action="{{ route('client.store') }}">
                    @csrf
                    <div class="mt-4">
                        <x-jet-label for="name">Nama <span class="text-red-500">*</span></x-jet-label>
                        <x-jet-input class="block w-full mt-1" type="text" name="name" :value="old('name')" placeholder="Contoh : Client "/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="redirect">Callback <span class="text-red-500">*</span></x-jet-label>
                        <x-jet-input class="block w-full mt-1" type="url" name="redirect" :value="old('redirect')" placeholder="Contoh : http://client.app/callback atau http://client.app/callback"/>
                        @error('redirect')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="url">Redirect URL <span class="text-red-500">*</span></x-jet-label>
                        <x-jet-input class="block w-full mt-1" type="url" name="url" :value="old('url')" placeholder="Contoh : http://client.app/redirect atau http://client.app/redirect"/>
                        @error('url')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="url">Visibilitas <span class="text-red-500">*</span></x-jet-label>
                        <input type="radio" name="visibility" id="public" value="public" required> Publik
                        <input type="radio" name="visibility" id="public" value="private" required> Pribadi
                        @error('visibility')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="thumbnail" value="Thumbnail" />
                        <input type="file" name="thumbnail" id="">
                        @error('thumbnail')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="modal-open ml-4" type="submit">
                            {{ __('Tambahkan') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

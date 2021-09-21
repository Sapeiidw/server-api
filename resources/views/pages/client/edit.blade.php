<x-admin-layout>
    @section('title', 'Edit Client')
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client > Edit') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 pb-8 pt-4">
                <form action="{{ route('client.update', $client->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mt-4">
                        <x-jet-label for="email" value="Name" />
                        <x-jet-input class="block w-full mt-1" type="text" name="name" value="{{ $client->name }}"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="url" value="Redirect URl" />
                        <x-jet-input class="block w-full mt-1" type="text" name="url" value="{{ $client->url }}"/>
                        @error('url')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="redirect" value="Callback" />
                        <x-jet-input class="block w-full mt-1" type="text" name="redirect" value="{{ $client->redirect }}"/>
                        @error('redirect')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4 items-center">
                        <input type="radio" name="visibility" id="public" value="public" class="mr-2" {{ $client->visibility == 'public' ? "checked" : '' }} required>Public
                        <input type="radio" name="visibility" id="public" value="private" class="mx-2" {{ $client->visibility == 'private' ? "checked" : '' }} required>Private
                        @error('visibility')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <input type="file" name="thumbnail" id="">
                        @error('thumbnail')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex mt-4 items-center justify-end">
                        <x-jet-button type="submit" class="mt-4">Perbarui</x-jet-button>
                        <x-jet-button type="reset" class="ml-2 mt-4">Reset</x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
            });
        });
    </script>
</x-admin-layout>

<x-admin-layout>
    @section('title', 'Edit Client')
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client > Edit') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">

                <x-alert></x-alert>

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
                    <input type="radio" name="visibility" id="public" value="public" {{ $client->visibility == 'public' ? "checked" : '' }} required>public
                    <input type="radio" name="visibility" id="public" value="private" {{ $client->visibility == 'private' ? "checked" : '' }} required>private
                    @error('visibility')
                        <span class="text-red-900 p-2">{{ $message }}</span>
                    @enderror
                    <input type="file" name="thumbnail" id="">
                    @error('thumbnail')
                        <span class="text-red-900 p-2">{{ $message }}</span>
                    @enderror
                    <x-jet-button type="submit" class="mt-4">Update</x-jet-button>
                    <x-jet-button type="reset" class="mt-4">Cancel</x-jet-button>
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

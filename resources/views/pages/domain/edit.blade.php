<x-admin-layout>
    @section('title', 'Edit domain')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">
                <form action="{{ route('domain.update', $domain->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mt-4">
                        <x-jet-label for="email" value="Name" />
                        <x-jet-input class="block w-full mt-1" type="text" name="name" value="{{ $domain->name }}"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex mt-4 items-center justify-end">
                        <x-jet-button type="submit" class="">Perbarui</x-jet-button>
                        <x-jet-button type="reset" class="ml-2">Reset</x-jet-button>
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

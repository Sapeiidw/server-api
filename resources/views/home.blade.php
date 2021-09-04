<x-app-layout>
    @section('title', 'Home')
    <div class=" max-w-7xl mx-auto py-7">
        <div class="max-w-6xl justify-items-start sm:px-6 lg:px-8">
            <div class=" flex items-center flex-wrap overflow-hidden">
                {{-- <x-clientlayouts/> --}}
                <x-clientstyle>
                    @slot('title')
                    <a href="http://client.domain.test">
                        judulunya client
                    </a>

                    @endslot
                    <div class="">
                        <a href="http://client.domain.test">
                            <img class="bg-white " src="{{ asset('img/undraw_text_files_au1q.svg') }}">
                        </a>
                    </div>
                </x-clientstyle>

                <x-clientstyle>
                    @slot('title')
                        judulunya client 1
                    @endslot
                    <div class="">
                        <a href="http://client.domain.test">
                            <img class="bg-white md:h-auto hover:grow hover:shadow-lg" src="{{ asset('img/undraw_text_files_au1q.svg') }}">
                        </a>
                    </div>
                </x-clientstyle>
            </div>
        </div>
    </div>
</x-app-layout>

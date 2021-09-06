<x-app-layout>
    @section('title', 'Home')
    <div class=" mx-auto py-7 ">
        <div class="flex items-center justify-center flex-wrap overflow-hidden">
            {{-- <x-clientlayouts/> --}}

            {{-- karena udh pake data base jadi lu modif design yang ini aja.
                yang component client layout hapus aja,
                langsung edit disini
            --}}
            @foreach ($client as $item)
            @unlessrole( $item->visibility == 'hidden' ? 'user' : '' )
            <div class="p-4 m-4 bg-white shadow rounded-xl">
                <a href="{{ $item->url }}" class="text-center">
                    <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->name }}" class="flex sm:w-56 sm:h-28 lg:w-96 lg:h-60 w-36 h-28 items-center justify-center bg-gray-100">
                    <h1 class="mx-2 mt-3 items-center justify-center">{{ $item->name }}</h1>
                </a>
            </div>
            @endunlessrole
            @endforeach
        </div>

    </div>
</x-app-layout>

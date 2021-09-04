<x-app-layout>
    <div class=" max-w-7xl mx-auto py-7">
        <div class="max-w-6xl justify-items-start sm:px-6 lg:px-8">
            <div class="flex items-center justify-center flex-wrap overflow-hidden">
                {{-- <x-clientlayouts/> --}}
                
                {{-- karena udh pake data base jadi lu modif design yang ini aja. 
                    yang component client layout hapus aja,
                    langsung edit disini
                --}}
                @foreach ($client as $item)
                @unlessrole( $item->visibility == 'hidden' ? 'user' : '' )
                <div class="p-4 m-2 bg-white shadow-lg">
                    <a href="{{ $item->url }}" class="text-center">
                        <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->name }}" class="w-96 h-auto">
                        <h1>{{ $item->name }}</h1>
                    </a>
                </div>
                @endunlessrole
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

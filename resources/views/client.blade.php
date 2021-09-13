<x-app-layout>
    @section('title', 'Home')
    <div class=" mx-auto py-7 ">
        <div class="flex items-center justify-center flex-wrap overflow-hidden">
            @foreach ($client as $item)
            @unlessrole( $item->visibility == 'hidden' ? 'user' : '' )
            <div class="px-4 pt-4 pb-3 m-4 dark:bg-gray-800 bg-white shadow rounded-xl">
                <a href="{{ $item->url }}" class="text-center">
                    <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->name }}" class="flex sm:w-56 sm:h-28 lg:w-96 lg:h-64 w-36 h-28 min-w-full items-center justify-center dark:bg-gray-700 bg-gray-100">
                    <div class="flex items-center justify-center mt-2">
                        <h1>{{ $item->name }}</h1>
                    </div>
                </a>
            </div>
            @endunlessrole
            @endforeach
        </div>
    </div>
</x-app-layout>

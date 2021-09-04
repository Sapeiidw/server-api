<div class=" min-h-screen shadow-xl flex md:justify-around sm:justify-center items-center">
    {{-- flex-wrap-reverse --}}
    <div class="w-full sm:max-w-2xl sm:max-h-3xl max-h-full sm:flex flex-row-reverse px-4 py-4 bg-white shadow-md justify-center rounded-3xl">
        <div class="flex mx-auto p-4 justify-center" >
            {{ $logo }}
        </div>

        <div class="sm:w-2/3 border border-gray-300 p-6 py-4 flex-none bg-white rounded-2xl">
            {{ $slot }}
        </div>

        {{-- <div class="">


        </div> --}}
        {{-- <div class="object-none flex object-right-bottom ">
            @yield('footer')
        </div> --}}

        {{-- <div>
            {{ $footer }}
        </div> --}}
    </div>
</div>

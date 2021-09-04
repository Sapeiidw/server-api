<div class="flex-col  shadow border border-gray-200 md:w-1/4 xl:w-1/3 bg-white rounded-3xl m-5">
    <div class="border border-gray-200 rounded-2xl bg-gray-100 pt-3 m-2">
        <div class="w-full sm:items-center sm:justify-center">
            <div class="flex-none">
                {{ $slot }}
            </div>
            <div class="m-1">
                <button class="w-full bg-white rounded-full p-1 font-semibold text-gray-600">
                    <div class="px-2 items-start justify-center">
                        {{ $title }}
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>


{{-- <div class="w-full md:w-1/4 xl:w-1/4 p-6 flex flex-col">
    <div class=" shadow-sm hover:grow hover:shadow-xl p-2 bg-gray-400 items-center flex flex-col rounded-md">
        <a href="http://client.domain.test">
            <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80">
            <div class="pt-1 flex items-center justify-between">
                <p class="">client 2</p>
            </div>
        </a>
    </div>
</div> --}}

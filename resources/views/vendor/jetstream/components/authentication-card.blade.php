<div class=" min-h-screen shadow-xl flex md:justify-around sm:justify-center items-center">
    <div class="w-full sm:max-w-2xl sm:max-h-3xl max-h-full sm:flex flex-row-reverse px-4 py-4 border dark:bg-gray-800 dark:border-gray-900 dark:text-white bg-white border-gray-300 shadow-md justify-center rounded-3xl">
        <div class="flex mx-auto p-4 justify-center" >
            {{ $logo }}
        </div>

        <div class="sm:w-2/3 border dark:bg-gray-800 dark:border-gray-900 dark:text-white border-gray-300 p-6 py-4 flex-none bg-white rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</div>

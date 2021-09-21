<div class=" relative w-full flex">
    <div class="sm:p-2 w-full">
        <div class="dark:bg-gray-800 dark:border-gray-700 sm:shadow sm:border border-gray-200 sm:rounded-2xl bg-white sm:p-2">
            <div class="dark:bg-gray-800 py-1 px-2 bg-gray-100 overflow-hidden rounded-xl">
                <div class="px-4 pt-4">
                    <x-alert></x-alert>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

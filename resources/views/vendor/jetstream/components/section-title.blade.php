<div class="flex w-full mx-auto">
    <div class="border dark:bg-gray-800 dark:border-gray-900 border-gray-200 bg-white w-full sm:rounded-2xl px-4 py-5">
        <h3 class="text-lg font-medium text-gray-900 px-2 mb-2">{{ $title }}</h3>
        <p class="pr-4 text-sm text-gray-600">
            {{ $description }}
        </p>
    </div>

    <div class="sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>

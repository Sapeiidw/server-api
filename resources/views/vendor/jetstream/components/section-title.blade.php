<div class="flex w-full justify-center mx-auto">
    <div class="flex border border-gray-200 bg-white w-full sm:rounded-2xl p-2">
        <div class="rounded-lg bg-white h-full py-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900 px-2">{{ $title }}</h3>
            <p class="pr-4 text-sm text-gray-600">
                {{ $description }}
            </p>
        </div>
    </div>

    <div class="sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>

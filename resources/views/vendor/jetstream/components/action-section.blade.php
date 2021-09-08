<div class="md:grid md:grid-cols-3 md:gap-6" {{ $attributes }}>
    <x-jet-section-title>
        <x-slot name="title" class="dark:text-white">{{ $title }}</x-slot>
        <x-slot name="description" class="dark:text-white">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="dark:bg-gray-800 dark:border-gray-900 border border-gray-200 px-4 py-5 sm:p-6 bg-white sm:rounded-2xl">
            {{ $content }}
        </div>
    </div>
</div>

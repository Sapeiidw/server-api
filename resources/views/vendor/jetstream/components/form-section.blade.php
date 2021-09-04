@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-jet-section-title>
        <div class="flex md:mt-0 md:col-span-2 justify-center">
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </div>
    </x-jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="border-t border-l border-r border-gray-200 px-4 py-5 bg-white sm:p-6 {{ isset($actions) ? 'sm:rounded-tl-2xl sm:rounded-tr-2xl' : 'sm:rounded-2xl' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="border-b border-l border-r border-gray-200 flex items-center justify-end px-4 py-3 bg-white text-right sm:px-6 sm:rounded-bl-2xl sm:rounded-br-2xl">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>

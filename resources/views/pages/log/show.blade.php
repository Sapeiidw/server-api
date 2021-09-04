<x-admin-layout>
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client > Edit') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 py-8">
                {{ $log }}
                {{-- @foreach ($log as $item)
                    {{ $item->log_name }}
                    {{ $item->name }}
                    {{ $item->subject }}
                    {{ $item->causer }}
                    {{ $item->created }}
                @endforeach --}}
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

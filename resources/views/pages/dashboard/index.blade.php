<x-admin-layout>
    @section('title', 'Admin')
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin') }}
            </h2>
        </x-slot>
    </div>
</x-admin-layout>

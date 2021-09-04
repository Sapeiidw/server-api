@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full items-center justify-center px-9 py-4 text-sm font-medium leading-5 text-blue-700 focus:outline-none transition'
            : 'hover:grow hover:shadow-md w-full items-center justify-center px-9 py-4 text-sm font-medium leading-5 text-gray-700 hover:text-blue-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

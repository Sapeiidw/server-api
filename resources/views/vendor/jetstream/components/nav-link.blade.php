@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 font-semibold text-sm leading-5 text-blue-500 focus:outline-none focus:border-indigo-700 transition'
            : 'hover:grow inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-semibold text-sm leading-5 text-gray-600 hover:text-gray-700 hover:border-blue-500 focus:outline-none focus:text-gray-700 focus:border-indigo-700 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

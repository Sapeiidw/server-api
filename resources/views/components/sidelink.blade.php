@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full dark:text-gray-200 dark:text-blue-500 flex flex-col md:flex-row justify-center sm:justify-start items-center p-2 md:px-5 text-sm font-medium leading-5 text-blue-700 focus:outline-none transition'
            : 'hover:grow hover:shadow-md dark:hover:grow dark:hover:shadow-md dark:text-white flex flex-col md:flex-row justify-center sm:justify-start items-center text-center sm:text-left w-full items-center p-2 md:px-5 text-sm font-medium leading-5 text-gray-700 hover:text-blue-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition dark:hover:text-blue-700 dark:hover:border-gray-300 dark:focus:outline-none dark:focus:text-gray-700 dark:focus:border-gray-300 dark:transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

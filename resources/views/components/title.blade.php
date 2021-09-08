@props(['value'])

<label {{ $attributes->merge(['class' => 'text-xl font-medium dark:font-semibold text-gray-900 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>

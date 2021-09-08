@props(['value'])

<label {{ $attributes->merge(['class' => 'text-lg font-medium text-gray-900 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>

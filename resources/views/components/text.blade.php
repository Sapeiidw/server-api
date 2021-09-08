@props(['value'])

<label {{ $attributes->merge(['class' => ' text-gray-600 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>

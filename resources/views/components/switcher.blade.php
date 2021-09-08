{{-- <span class="text-gray-700 dark:text-gray-100">light</span> --}}
<div @click="darkMode = !darkMode"
    class="relative flex flex-column items-center w-9 h-5 mx-2 pl-0 rounded-full bg-gray-300 cursor-pointer">
    {{-- <i class="fas fa-sun"></i> --}}
    {{-- <i class="fas fa-moon"></i> --}}
        <span
        class="block fas fa-moon border border-gray-300 rounded-full items-center appearance-none cursor-pointer outline-none transition-all ease-in-out duration-500"
        x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
        x-bind:class="{ 'ml-4': darkMode }">
        </span>
</div>
{{-- <span class="text-gray-700 dark:text-gray-100 mr-2">dark</span> --}}

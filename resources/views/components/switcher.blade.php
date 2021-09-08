<div @click="darkMode = !darkMode"
    class="relative flex flex-column items-center w-9 h-5 mx-2 pl-0 rounded-full bg-gray-300 dark:bg-gray-600 cursor-pointer">
        <span
        class="block fas rounded-full items-center appearance-none cursor-pointer outline-none transition-all ease-in-out duration-300"
        x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
        x-bind:class="darkMode ? 'fa-moon text-white ml-4' : 'fa-sun text-yellow-500' ">
        </span>
</div>


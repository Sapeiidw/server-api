<span class="text-gray-700 dark:text-gray-100">light</span>
<div @click="darkMode = !darkMode"
    class="relative flex flex-column items-center w-12 h-6 mx-2 pl-1 rounded-full bg-gray-300 cursor-pointer">
        <span
        class="block w-5 h-5 border border-gray-300 rounded-full bg-white appearance-none cursor-pointer outline-none transition-all ease-in-out duration-500"
        x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
        x-bind:class="{ 'ml-5': darkMode }"> 
        </span>
</div>
<span class="text-gray-700 dark:text-gray-100">dark</span>

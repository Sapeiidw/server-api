<aside class=" h-min-screen dark:bg-gray-800 dark:text-white dark:border-gray-700 md:max-w-1/5 w-1/5 sticky-top-0 relative shadow-md rounded-t-2xl overflow-x-hidden border border-gray-200 mt-2 ml-2 bg-sidebar bg-white sm:block">
    <nav class="text-white text-base font-semibold overflow-x-hidden pt-3 ">
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                <i class="text-xl fas fa-user m-2"></i>
                <div class="">
                    {{ __('User') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between" >
            <x-sidelink href="{{ route('role.index') }}" :active="request()->routeIs('role.*')">
                <i class="text-xl fas fa-user-tag m-2"></i>
                <div class="">
                    {{ __('Role') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('permission.index') }}" :active="request()->routeIs('permission.*')">
                <i class="text-xl fas fa-id-badge m-2"></i>
                <div class="">
                    {{ __('Permission') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('client.index') }}" :active="request()->routeIs('client.*')">
                <i class="text-xl fas fa-cogs m-2"></i>
                <div class="">
                    {{ __('Client') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('log.index') }}" :active="request()->routeIs('log.*')">
                <i class="text-xl fas fa-clipboard-list m-2"></i>
                <div class="">
                    {{ __('Log Activity') }}
                </div>
            </x-sidelink>
        </div>
    </nav>
</aside>

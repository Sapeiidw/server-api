<aside class="md:max-w-1/5 sticky-top-0 relative shadow-md rounded-t-2xl border border-gray-200 mt-2 ml-2 bg-sidebar bg-white h-min-screen w-1/5 sm:block">
    <nav class="text-white text-base font-semibold pt-3 ">
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                <i class="fas fa-user m-2"></i>
                {{ __('User') }}
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between" >
            <x-sidelink href="{{ route('role.index') }}" :active="request()->routeIs('role.*')">
                <i class="fas fa-user-tag m-2 mr-1"></i>
                {{ __('Role') }}
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('permission.index') }}" :active="request()->routeIs('permission.*')">
                <i class="fas fa-id-badge m-2"></i>
                {{ __('Permission') }}
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('client.index') }}" :active="request()->routeIs('client.*')">
                <i class="fas fa-id-badge m-2"></i>
                {{ __('Client') }}
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('log.index') }}" :active="request()->routeIs('log.*')">
                <i class="fas fa-id-badge m-2"></i>
                {{ __('Log Activity') }}
            </x-sidelink>
        </div>
    </nav>
</aside>

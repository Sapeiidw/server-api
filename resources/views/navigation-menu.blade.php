<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="shadow">
        <div class="px-6 sm:px-10 lg:px-12">
            <div class="flex justify-between items-center mx-auto h-24">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center dark:text-white">
                        <a href="{{ route('home') }}">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>
                    @role("super-admin|admin")
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link class=" lg:text-base font-medium dark:text-white" href="{{ route('user.index') }}" :active="request()->routeIs('user.*','permission.*','role.*','log.*','client.*')">
                            {{ __('Admin') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link class=" lg:text-base font-medium dark:text-white" href="{{ route('dokumentasi') }}" :active="request()->routeIs('dokumentasi')">
                            {{ __('Dokumentasi') }}
                        </x-jet-nav-link>
                    </div>
                    @endrole
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-4 relative flex items-center dark:text-white">
                        <!-- component -->
                        <x-switcher></x-switcher>
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm text-bold border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md dark:bg-gray-700 dark:border-gray-900 text-gray-500 bg-gray-200 hover:text-gray-700 focus:outline-none transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    <i class="fas fa-user-circle m-1"></i>
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t dark:border-gray-900 border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt m-1"></i>
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <x-switcher></x-switcher>
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-full text-blue-500 hover:text-blue-800 hover:bg-gray-300 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 ">
            <x-jet-responsive-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.*','permission.*','role.*')">
                {{ __('Admin') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('dokumentasi') }}" :active="request()->routeIs('dokumentasi')">
                {{ __('Dokumentasi') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 dark:border-gray-900 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base dark:text-white text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm dark:text-white text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    <i class="fas fa-user-circle m-1"></i>
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt m-1"></i>
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<x-guest-layout>
    @section('title', 'Login')
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-title value="{{ __('Sign in') }}"/>
            </div>

            <div class="my-4 ">
                <x-jet-input placeholder="E-mail" id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-input placeholder="Password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-start items-center mt-4 mb-20">
                <label for="remember_me" class="flex items-center mr-2">
                    <x-jet-checkbox id="remember_me" name="remember" />

                </label>
                <x-text value="{{ __('Ingat saya') }}"/>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-col">
                    @if (Route::has('password.request'))
                <a class="underline text-sm dark:text-red-500 text-red-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('lupa kata sandi Anda?') }}
                </a>
                @endif
                <a class=" flex-row underline text-sm dark:text-white text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Tidak punya akun? Daftar') }}
                </a>
                </div>

                <x-jet-button class="">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

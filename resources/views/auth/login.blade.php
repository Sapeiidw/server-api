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
                <h1 class="font-semibold text-xl text-gray-600">
                    Sign in
                </h1>
            </div>

            <div class="my-4 ">
                <x-jet-input placeholder="E-mail" id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-input placeholder="Password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between items-center mt-4 mb-12">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-col">
                    @if (Route::has('password.request'))
                <a class="underline text-sm text-red-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <a class=" flex-row underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Dont have an account? Register') }}
                </a>
                </div>

                <x-jet-button class="">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
            {{-- <div class="flex flex-col-reverse">
            @section('footer')


            @endsection
            </div> --}}


        </form>
        {{-- @slot('footer')
        <a class=" flex-row underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
            {{ __('Dont have an account? Register') }}
        </a>
        @endslot --}}

    </x-jet-authentication-card>
</x-guest-layout>

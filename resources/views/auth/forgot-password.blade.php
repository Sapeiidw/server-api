<x-guest-layout>
    @section('title', 'Forgot Password')
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="flex md:max-w-sm mb-10 text-sm text-gray-600 text-justify">
            <x-text for="" value="{{ __('lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan email kepada Anda tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}"/>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block mt-20">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Tautan Atur Ulang Kata Sandi Email') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

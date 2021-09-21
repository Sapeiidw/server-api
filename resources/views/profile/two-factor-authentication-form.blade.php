<x-jet-action-section>
    <div class="dark:bg-gray-800 m-4 bg-red-600">
        <x-slot name="title">
            <x-title  value="{{ __('Otentikasi Dua Faktor') }}"/>
        </x-slot>

        <x-slot name="description">
            <div class="px-2 text-gray-600">
                <x-text value="{{ __('Tambahkan keamanan tambahan ke akun Anda menggunakan otentikasi dua faktor.') }}"/>
            </div>
        </x-slot>
    </div>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                <x-title value="{{ __('Anda telah mengaktifkan otentikasi dua faktor.') }}"/>
            @else
                <x-title  value="{{ __('Anda belum mengaktifkan otentikasi dua faktor.') }}"/>
            @endif
        </h3>

        <div class="mt-3 w-full text-sm text-gray-600">
            <x-text for="" value="{{ __('Saat otentikasi dua faktor diaktifkan, Anda akan dimintai token acak yang aman selama otentikasi. Anda dapat mengambil token ini dari aplikasi Google Authenticator ponsel Anda.') }}"/>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <x-jet-label  value="{{ __('Otentikasi dua faktor sekarang diaktifkan. Pindai kode QR berikut menggunakan aplikasi autentikator ponsel Anda.') }}"/>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <x-jet-label   value="{{ __('Simpan kode pemulihan ini di pengelola kata sandi yang aman. Mereka dapat digunakan untuk memulihkan akses ke akun Anda jika perangkat otentikasi dua faktor Anda hilang.') }}"/>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="flex justify-end mt-6">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>

<x-admin-layout>
    @section('title', 'Log')
    <div class="w-4/5">
        <x-boxtable>
            <div class="dark:bg-gray-700 bg-white mx-3 mb-2 px-4 sm:px-8 py-8 rounded-2xl">
                <div class="2xl:flex justify-between items-center m-1 mt-2 p-2 rounded-2xl overflow-y-hidden">
                    <div class="md:w-1/3 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="dark:bg-gray-700 rounded-full h-24 w-24 object-cover"
                                src="{{ $log->causer->profile_photo_url ?? "https://ui-avatars.com/api/?name=".$user->name
                                }}"
                                alt="" />
                        </div>
                        <div class="ml-6 flex-none">
                            <div class="ml-2 font-semibold text-3xl mb-4">
                                {{ $log->causer->name }}
                            </div>
                            <div class="ml-2 text-2xl">
                                {{ $log->causer->email }}
                            </div>
                            <div class="flex-none justify-start">
                                <x-badge>{{ $log->causer->roles->first()->name ?? '?'}}</x-badge>
                            </div>
                        </div>
                    </div>
                    <div class="flex-none w-1/3 ml-3 mt-1">
                        <div class="flex items-center">
                            Dibuat Pada:
                            {{ $log->causer->created_at }}
                        </div>
                        <div class="flex items-center 2xl:mt-7 mt-1">
                            Terverifikasi:
                            @if ($log->causer->email_verified_at)
                                <i class="fas fa-check ml-7"></i>
                            @else
                                <i class="fas fa-times ml-7" style="color: red"></i>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <x-jet-section-border />
            <div class="flex ml-5 items-center justify-start">
                Nama Log : {{ $log->log_name }}
            </div>
            <x-jet-section-border />
            <div class="flex ml-5 items-center justify-start">
                Deskripsi : {{ $log->description }}
            </div>
            <x-jet-section-border />
            <div class="flex ml-5 items-center justify-start">
                Properti : {{ $log->properties }}
            </div>
            <x-jet-section-border />
            <div class="flex ml-5 items-center justify-start">
                Dibuat Pada : {{ $log->created_at }}
            </div>
            <x-jet-section-border />
        </x-boxtable>
    </div>
</x-admin-layout>

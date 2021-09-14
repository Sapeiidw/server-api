<x-admin-layout>
    @section('title', 'Log')
    <div class="w-4/5">
        <x-boxtable>
            <div>
                <div class="dark:bg-gray-700 bg-white m-2 px-4 sm:px-8 py-8 rounded-2xl">
                    <div class="md:flex justify-between items-center m-1 mt-2 p-2 rounded-2xl overflow-y-hidden">
                        <div class="md:w-1/3 flex items-center">
                            <div class="flex-shrink-0 w-24 h-24">
                                <img class="w-full h-full rounded-full"
                                    src="{{ $log->causer->profile_photo_url ?? "https://ui-avatars.com/api/?name=".$user->name
                                    }}"
                                    alt="" />
                            </div>
                            <div class=" ml-6 flex-none">
                                <div class=" font-semibold text-3xl mb-4">
                                    {{ $log->causer->name }}
                                </div>
                                <div class="text-2xl">
                                    {{ $log->causer->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-jet-section-border />
                <div class="flex-none  text-sm ml-3">
                    <div class="flex m-2 items-center">
                        Create at:
                        {{ $log->causer->created_at }}
                    </div>
                    <div class="flex m-2 items-center">
                        Email Verified:
                        @if ($log->causer->email_verified_at)
                            <i class="fas fa-check ml-5"></i>
                        @else
                            <i class="fas fa-times ml-5" style="color: red"></i>
                        @endif
                    </div>
                </div>
                <x-jet-section-border />
                <div class="ml-2 m-2 justify-start">
                    <x-badge>{{$log->causer->roles->first()->name ?? '?'}}</x-badge>
                </div>
                <x-jet-section-border />
                <div class="flex ml-5 items-center justify-start">
                    {{ $log->description }}
                </div>
                <x-jet-section-border />
                <div class="flex ml-5 items-center justify-start">
                    {{ $log->created_at }}
                </div>
                <x-jet-section-border />
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

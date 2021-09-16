<x-admin-layout>
    @section('title', 'User')
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="dark:bg-gray-700 dark:text-white bg-white md:flex justify-between items-center m-1 mt-2 p-2 rounded-2xl overflow-y-hidden">
                <div class="md:w-1/3 m-3 flex items-center">
                    <div class="flex-shrink-0">
                        <img class="dark:bg-gray-700 rounded-full h-24 w-24 object-cover"
                            src="{{ $user->profile_photo_url ?? "https://ui-avatars.com/api/?name=".$user->name
                            }}"
                            alt="" />
                    </div>
                    <div class="ml-3 flex-none">
                        <div class="ml-2 font-semibold">
                            {{ $user->name }}
                        </div>
                        <div class="ml-2">
                            {{ $user->email }}
                        </div>
                        <div class="flex-none justify-start">
                            <x-badge>{{ $user->roles->first()->name ?? '?'}}</x-badge>
                        </div>
                    </div>
                </div>
                <div class="flex-none xl:w-1/3 ml-3">
                    <div class="flex items-center">
                        Create at:
                        {{ $user->created_at }}
                    </div>
                    <div class="flex items-center">
                        Verified:
                        @if ($user->email_verified_at)
                            <i class="fas fa-check ml-7"></i>
                        @else
                            <i class="fas fa-times ml-7" style="color: red"></i>
                        @endif
                    </div>
                </div>

            </div>
            <div class="mx-auto pt-4 overflow-x-auto">
                <div class="inline-block border dark:border-gray-900 min-w-full rounded-2xl overflow-hidden">
                    <table class="min-w-full leading-normal ">
                        <thead>
                            <x-tr>
                                <x-th>
                                    <i class="fas fa-user mr-1"></i>
                                    Log Name
                                </x-th>
                                <x-th>
                                    <i class="fas fa-envelope mr-1"></i>
                                    description
                                </x-th>
                                <x-th>
                                    <i class="fas fa-folder-plus mr-1"></i>
                                    Causer
                                </x-th>
                                <x-th>
                                    <i class="fas fa-user-check mr-1"></i>
                                    Properties
                                </x-th>
                            </x-tr>
                        </thead>
                        <tbody>
                            @forelse ( $activity as $item )
                            <x-tr>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->log_name }}
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->description }}
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->causer->name }}
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->properties ?? null }}
                                    </div>
                                </x-td>
                            </x-tr>
                            @empty
                                <div class="m-3">
                                    Tidak Ada Activity
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    <div
                        class="px-5 py-5 dark:bg-gray-700 dark:text-white bg-white flex flex-col xs:flex-row items-center xs:justify-between          ">
                        {{ $activity->links() }}
                    </div>
                </div>
            </div>
        </x-boxtable>
</x-admin-layout>

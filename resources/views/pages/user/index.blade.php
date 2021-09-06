<x-admin-layout>
    @section('title', 'User')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> --}}
    <div class="w-4/5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User') }}
            </h2>
        </x-slot>
        <x-boxtable>
            <div class="flex justify-between sm:flex-row flex-col py-4 px-2">
                <div class="flex relative sm:w-3/4">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <form class="w-full" action="{{ route('user.index') }}" method="get">
                        <input placeholder="Search" name="search"
                        class="appearance-none rounded-full border border-gray-400 border-b block sm:pt-2 pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </form>
                </div>
                <x-jet-button>
                    <a href="{{ route('user.create') }}" >Add User</a>
                </x-jet-button>

            </div>
            <div class="mx-auto pt-4 overflow-x-auto">
                <div class="inline-block border min-w-full rounded-2xl overflow-hidden">
                    <table class="min-w-full leading-normal ">
                        <thead>
                            <x-tr>
                                <x-th>
                                    <i class="fas fa-user mr-1"></i>
                                    Name
                                </x-th>
                                <x-th>
                                    <i class="fas fa-envelope mr-1"></i>
                                    Email
                                </x-th>
                                <x-th>
                                    <i class="fas fa-folder-plus mr-1"></i>
                                    Created at
                                </x-th>
                                <x-th>
                                    <i class="fas fa-user-check mr-1"></i>
                                    Verified
                                </x-th>
                                <x-th>
                                    <i class="fas fa-user-tag mr-1"></i>
                                    Role
                                </x-th>
                                <x-th>
                                    <i class="fas fa-edit mr-1"></i>
                                    Action
                                </x-th>
                            </x-tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                            <x-tr>
                                <x-td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="{{ $item->profile_photo_url ?? "https://ui-avatars.com/api/?name=".$item->name
                                                }}"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            {{ $item->name }}
                                        </div>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->email }}
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        {{ $item->created_at }}
                                    </div>
                                </x-td>
                                <x-td>
                                    @if ($item->email_verified_at)
                                        <i class="fas fa-check ml-7"></i>
                                    @else
                                        <i class="fas fa-times ml-7" style="color: red"></i>
                                    @endif
                                </x-td>
                                <x-td>
                                    <div class=" ml-3">
                                        <x-badge>{{ $item->roles->first()->name ?? '?'}}</x-badge>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class="flex sm:flex-row flex-col w-1/6 justify-between ml-2">
                                        <a href="{{ route('user.show',$item->id) }}" class="text-blue-800 flex flex-row items-center"><i class="fas fa-eye mx-2"></i></i>View</a>
                                        <a href="{{ route('user.edit',$item->id) }}" class="text-blue-800 flex flex-row items-center"><i class="fas fa-pen mx-2"></i>Edit</a>
                                        <form action="{{ route('user.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('Are u Sure!!')" class="text-red-900 flex flex-row items-center"><i class="fas fa-trash-alt mx-2"></i>Delete</button>
                                        </form>
                                    </div>
                                </x-td>
                            </x-tr>
                            @empty
                            <x-tr>
                                Data gak ada boss
                                </x-tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white flex flex-col xs:flex-row items-center xs:justify-between">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </x-boxtable>
    </div>

</x-admin-layout>

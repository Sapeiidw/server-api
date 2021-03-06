<x-admin-layout>
    @section('title', 'Client')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-3 mb-2 flex justify-between sm:flex-row flex-col">
                <div class="block relative mb-2 w-3/4">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <form action="{{ route('client.index') }}" method="get">
                        <input placeholder="Search" name="search"
                        class="appearance-none rounded-full border dark:border-gray-800 dark:bg-gray-700 dark:text-white border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </form>
                </div>
                @can('create-client')
                <x-jet-button>
                    <a href="{{ route('client.create') }}" >Tambah Client</a>
                </x-jet-button>
                @endcan
            </div>
            <div class="mx-auto overflow-x-auto">
                <div class="inline-block border dark:border-gray-800 dark:text-white min-w-full shadow rounded-2xl overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <x-tr>
                                <x-th>
                                    <i class="fas fa-id-badge mr-1"></i>
                                    Client
                                </x-th>
                                <x-th>
                                    <i class="fas fa-id-badge mr-1"></i>
                                    Link
                                </x-th>
                                <x-th>
                                    <i class="fas fa-id-badge mr-1"></i>
                                    ID
                                </x-th>
                                <x-th>
                                    <i class="fas fa-id-badge mr-1"></i>
                                    SECRET
                                </x-th>
                                <x-th>
                                    <i class="fas fa-id-badge mr-1"></i>
                                    Visibilitas
                                </x-th>
                                @can('update-client','delete-client')
                                <x-th>
                                    <i class="fas fa-edit mr-1"></i>
                                    Tindakan
                                </x-th>
                                @endcan
                            </x-tr>
                        </thead>
                        <tbody>
                            <x-tr>
                                <x-td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="{{ $client->item ? asset('storage/'.$client->photo) : "https://ui-avatars.com/api/?name=".$client->name
                                                }}"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            {{ $client->name }}
                                        </div>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class="ml-3">
                                        Callback: <a class="text-blue-600">{{ $client->redirect }}</a> <br>
                                        Redirect: <a class="text-blue-600">{{ $client->url }}</a>
                                    </div>
                                </x-td>

                                <x-td>
                                    <div class="ml-3">
                                        <a>{{ $client->id }}</a>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class="ml-3">
                                        <a>{{ $client->secret }}</a>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class="ml-3">
                                        <a>{{ $client->visibility }}</a>
                                    </div>
                                </x-td>
                                @can('update-client','delete-client')
                                <x-td>
                                    <div class="flex sm:flex-row flex-col w-1/12 justify-between ml-2">
                                        @can('update-client')
                                        <a href="{{ route('client.edit', $client->id) }}"
                                            class="dark:text-blue-500 text-blue-800 flex flex-row items-center">
                                            <i class="fas fa-pen mx-2"></i>
                                            Edit
                                        </a>
                                        @endcan
                                        @can('delete-client')
                                        <form action="{{ route('client.destroy', $client->id) }}" method="post" class="relative inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="dark:text-red-500 text-red-900 flex flex-row items-center"
                                            onclick="return confirm('are you sure?!')">
                                            <i class="fas fa-trash-alt mx-2"></i>
                                            Hapus
                                        </button>
                                        </form>
                                        @endcan
                                    </div>
                                </x-td>
                                @endcan
                            </x-tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

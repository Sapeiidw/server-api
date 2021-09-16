<x-admin-layout>
    @section('title', 'Client')
    <div class="w-4/5">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client') }}
        </h2>
    </x-slot>
    <x-boxtable>
        <div class="flex justify-between sm:flex-row flex-col py-4 px-2">
            <div class="flex relative dark:text-white sm:w-3/4">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <form class="w-full" action="{{ route('client.index') }}" method="get">
                    <input placeholder="Search" name="search"
                    class="appearance-none rounded-full border dark:border-gray-800 dark:bg-gray-700 dark:text-white border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </form>
            </div>
            @can('create-client')
            <x-jet-button>
                <a href="{{ route('client.create') }}" >Add Client</a>
            </x-jet-button>
            @endcan

        </div>
        <div class="mx-auto overflow-x-auto">
            <div class="inline-block dark:text-white dark:border-gray-800 border min-w-full shadow rounded-2xl overflow-hidden">
                <table class=" dark:bg-gray-700 min-w-full leading-normal">
                    <thead>
                        <x-tr>
                            <x-th>
                                <i class="fas fa-hashtag"></i>
                            </x-th>
                            <x-th>
                                <i class="fas fa-cogs mr-1"></i>
                                Client
                            </x-th>
                            <x-th>
                                <i class="fas fa-link mr-1"></i>
                                Link
                            </x-th>
                            @can('read-client','update-client','delete-client')
                            <x-th>
                                <i class="fas fa-edit mr-1"></i>
                                Action
                            </x-th>
                            @endcan
                        </x-tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $item)
                            <x-tr>
                                <x-td>
                                    <p class="dark:text-white text-gray-900 whitespace-no-wrap ml-3">{{ $loop->iteration + $clients->perPage() * ($clients->currentPage() -1 ) }}</p>
                                </x-td>
                                <x-td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="{{ $item->item ? asset('storage/'.$item->photo) : "https://ui-avatars.com/api/?name=".$item->name
                                                }}"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            {{ $item->name }}
                                        </div>
                                    </div>
                                </x-td>
                                <x-td>
                                    <div class="ml-3">
                                        <a>{{ $item->redirect }}</a>
                                    </div>
                                </x-td>
                                @can('read-client','update-client','delete-client')
                                <x-td>
                                    <div class="flex lg:flex-row flex-col sm:w-1/5 md:justify-between justify-center items-center ml-2">
                                        @can('read-client')
                                        <a href="{{ route('client.show', $item->id) }}"
                                            class="dark:text-blue-500  text-blue-800 flex flex-row items-center">
                                            <i class="fas fa-eye mx-2"></i>
                                            View
                                        </a>
                                        @endcan
                                        @can('update-client')
                                        <a href="{{ route('client.edit', $item->id) }}"
                                            class="dark:text-blue-500 text-blue-800 flex flex-row items-center">
                                            <i class="fas fa-pen mx-2"></i>
                                            Edit
                                        </a>
                                        @endcan
                                        @can('delete-client')
                                        <form action="{{ route('client.destroy', $item->id) }}" method="post" class="relative inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="dark:text-red-500 text-red-900 flex flex-row items-center"
                                            onclick="return confirm('are you sure?!')">
                                            <i class="fas fa-trash-alt mx-2"></i>
                                            Delete
                                        </button>
                                        </form>
                                        @endcan
                                    </div>
                                </x-td>
                                @endcan
                            </x-tr>
                        @endforeach
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 dark:bg-gray-700 bg-white flex flex-col xs:flex-row items-center xs:justify-between">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </x-boxtable>
</div>
</x-admin-layout>

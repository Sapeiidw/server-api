<x-admin-layout>
    @section('title', 'Create User')
    <div class="w-4/5">
        <x-boxtable>
            <div class="mx-auto px-4 sm:px-8 pt-2 pb-8">
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-jet-input placeholder="Nama"
                        class="block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                        type="text" name="name" :value="old('name')"/>
                        @error('name')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-jet-input placeholder="Email"
                            class="block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                            type="email" name="email" :value="old('email')" />
                        @error('email')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <x-jet-input placeholder="Password"  id="password"
                            class="block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
                        @error('password')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-jet-input placeholder="Konfirmasi Password" id="password_confirmation"
                            class="block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                            type="password"
                            name="password_confirmation" required />
                    </div>

                    @role('super-admin')
                    <div class="mt-4">
                        <x-jet-label for="role" value="Role" />
                        <select name="role" id="role"
                            class="block w-full rounded-3xl mt-3 shadow-sm border dark:text-white dark:bg-gray-700 dark:border-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-red-900 p-2">{{ $message }}</span>
                        @enderror
                    </div>
                    @endrole
                    <div class="flex mt-4 justify-end items-center">
                        <x-jet-button type="submit">Tambahkan</x-jet-button>
                    </div>
                </form>
            </div>
        </x-boxtable>
    </div>
</x-admin-layout>

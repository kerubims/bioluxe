<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
        <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input id="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    @error('name')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block font-medium text-sm text-gray-700 dark:text-gray-300">No. Telepon (Opsional)</label>
                    <input id="phone" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}" />
                    @error('phone')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Role User</label>
                    <select id="role" name="role" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ str_replace('_', ' ', strtoupper($role->name)) }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                    <input id="password_confirmation" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4 gap-3">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 transition ease-in-out duration-150">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

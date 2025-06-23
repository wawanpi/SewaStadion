<x-guest-layout>
    <section class="bg-light dark:bg-dark pt-56 pb-36 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md px-6">
            <!-- Logo atau Judul -->
            <div class="text-center mb-6">
                <a href="#" class="text-2xl font-semibold text-gray-900 dark:text-white">Teras Kayu Purwokerto</a>
            </div>

            <!-- Kotak Form -->
            <div class="bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Tombol Register -->
                        <button type="submit"
                            class="w-full text-white bg-third hover:bg-four font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150 ease-in-out">
                            Buat
                        </button>

                        <!-- Link Login -->
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="font-medium text-third hover:underline dark:text-second">Login disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

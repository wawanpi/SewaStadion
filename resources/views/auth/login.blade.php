<x-guest-layout>
    <section class="bg-light dark:bg-dark pt-28 pb-20 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">
            <!-- Logo & Title -->
            <div class="text-center mb-6">
                <!-- Logo -->
                <img src="{{ asset('storage/image/logo.jpg') }}" class="mx-auto h-16 w-16 rounded-full mb-2" alt="Logo Dikpora">
                
                <!-- Title -->
                <a href="#" class="flex items-center justify-center text-2xl font-semibold text-gray-900 dark:text-white">
                    Dikpora Bantul
                </a>
            </div>

            <div class="w-full bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <!-- Status Session -->
                    <x-auth-session-status class="mb-4 text-sm text-green-600 dark:text-green-400" :status="session('status')" />

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600 dark:text-red-400" />
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500 dark:bg-gray-700 dark:border-gray-600"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Ingatkan saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-amber-600 hover:underline dark:text-amber-400">Lupa password?</a>
                            @endif
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full text-white bg-third hover:bg-four font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors duration-300">
                            Masuk
                        </button>

                        <!-- Daftar -->
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-third hover:underline dark:text-second">Daftar disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

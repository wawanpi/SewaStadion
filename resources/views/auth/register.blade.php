<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'Dikpora Bantul') }}</title>
    
    {{-- Memuat Font Poppins dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-gray-900">

    {{-- Container Utama: Full Screen Flex --}}
    <div class="min-h-screen w-full flex overflow-hidden">

        {{-- BAGIAN KIRI: Artistik & Dekoratif (Sama dengan Login) --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-yellow-50 via-green-500 to-green-800 items-center justify-center overflow-hidden">
            
            {{-- Dekorasi Shape Abstrak --}}
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-white/20 rounded-full blur-3xl -translate-x-1/3 -translate-y-1/3 mix-blend-overlay"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-yellow-400/20 rounded-full blur-3xl translate-x-1/4 translate-y-1/4 mix-blend-color-dodge"></div>
            
            {{-- Konten Tengah Kiri --}}
            <div class="relative z-10 text-center px-10">
                <div class="relative w-36 h-36 mx-auto mb-8 group">
                    <div class="absolute inset-0 bg-white/50 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                    <div class="relative w-full h-full bg-white rounded-full flex items-center justify-center shadow-2xl transform transition-transform duration-500 group-hover:scale-105">
                         <img src="{{ asset('storage/image/logo.jpg') }}" class="w-28 h-28 object-contain rounded-full" alt="Logo Dikpora">
                    </div>
                </div>
                
                <h2 class="text-5xl font-extrabold text-white mb-4 drop-shadow-md tracking-tight leading-tight">
                    Bergabunglah
                </h2>
                <div class="h-1.5 w-24 bg-yellow-400 mx-auto rounded-full mb-6 shadow-lg"></div>
                <p class="text-white/95 text-xl font-semibold tracking-wide uppercase">
                    Bersama Dikpora Bantul
                </p>
                <p class="text-green-50 text-base font-light mt-4 max-w-sm mx-auto leading-relaxed opacity-90">
                    Daftar akun baru untuk menikmati kemudahan akses layanan fasilitas olahraga secara online.
                </p>
            </div>

            {{-- Wave Decoration Abstrak --}}
            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180 pointer-events-none">
                <svg class="relative block w-[calc(100%+1.3px)] h-[150px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#FFFFFF" fill-opacity="0.1"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="#FFFFFF" fill-opacity="0.2"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#FFFFFF" fill-opacity="0.3"></path>
                </svg>
            </div>
        </div>

        {{-- BAGIAN KANAN: Form Register Clean --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white dark:bg-gray-900 px-6 py-12 lg:px-20 relative overflow-y-auto">
            
            {{-- Tombol Kembali --}}
            <a href="/" class="absolute top-8 right-8 text-gray-400 hover:text-green-600 dark:hover:text-green-400 transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            <div class="w-full max-w-[450px] space-y-6">
                {{-- Header Mobile Only --}}
                <div class="text-center lg:text-left">
                    <img src="{{ asset('storage/image/logo.jpg') }}" class="h-20 w-20 mx-auto lg:hidden rounded-full mb-6 shadow-lg object-cover" alt="Logo">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white tracking-tight mb-2">Sign Up</h2>
                    <p class="text-base text-gray-500 dark:text-gray-400 font-normal">
                        Lengkapi data diri Anda untuk membuat akun baru.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <div class="relative">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-green-600 text-sm font-medium placeholder-gray-400 shadow-sm outline-none"
                                placeholder="John Doe">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500 font-medium" />
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-green-600 text-sm font-medium placeholder-gray-400 shadow-sm outline-none"
                                placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-medium" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-green-600 text-sm font-medium placeholder-gray-400 shadow-sm outline-none tracking-widest"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-medium" />
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-green-600 text-sm font-medium placeholder-gray-400 shadow-sm outline-none tracking-widest"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500 font-medium" />
                    </div>

                    <button type="submit" 
                        class="w-full flex items-center justify-center py-4 px-6 border border-transparent rounded-xl shadow-lg shadow-green-500/30 text-sm font-bold text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 focus:outline-none focus:ring-4 focus:ring-green-500/50 transform hover:-translate-y-0.5 transition-all duration-300 tracking-wide uppercase mt-4">
                        DAFTAR AKUN
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div class="text-center mt-8">
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-bold text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 transition-colors duration-200 ml-1">
                                Masuk disini
                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
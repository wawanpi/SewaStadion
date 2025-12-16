<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sewa Stadion') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || 
            (!('color-theme' in localStorage) && 
            window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 min-h-screen">

    {{-- LOGIKA NAVIGASI --}}
    @auth
        {{-- Jika User Login --}}
        
        {{-- 1. Cek Admin (Sesuaikan logika 'is_admin' atau 'role' dengan database Anda) --}}
        @if(Auth::user()->is_admin == 1 || Auth::user()->role === 'admin')
            @include('layouts.navigationAdmin')
        
        {{-- 2. Jika User Biasa --}}
        @else
            {{-- Cek apakah file 'navigationUser' ada, jika tidak pakai 'navigation' biasa --}}
            @if(view()->exists('layouts.navigationUser'))
                @include('layouts.navigationUser')
            @elseif(view()->exists('layouts.navigation'))
                @include('layouts.navigation')
            @else
                <div class="p-4 bg-red-500 text-white">Error: File navigasi user tidak ditemukan!</div>
            @endif
        @endif

    @else
        {{-- Jika Pengunjung (Belum Login) --}}
        @if(view()->exists('layouts.navigationGuest'))
            @include('layouts.navigationGuest')
        @elseif(view()->exists('layouts.navigation'))
            @include('layouts.navigation')
        @endif
    @endauth

    {{-- PAGE CONTENT --}}
    {{-- Tambahkan padding top (pt-20) agar konten tidak tertutup navbar fixed --}}
    <main class="pt-20">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- SCRIPTS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    @include('sweetalert::alert')
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sewa Stadion') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Script -->
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

    {{-- Navbar berdasarkan role --}}
        @auth
            @if(Auth::user()->role === 'admin')
                @include('layouts.navigationAdmin')
            @else
                @include('layouts.navigationUser')
            @endif
        @else
            @include('layouts.navigationGuest') {{-- Untuk pengunjung --}}
        @endauth
    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Optional Footer --}}
    {{-- @include('layouts.footer') --}}

    {{-- External Scripts --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sewa Lapangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-red text-gray-800 dark:bg-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <header class="bg-red shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-red-600">Sultan Agung</div>
            <nav class="hidden md:flex gap-6 text-sm">
                <a href="#" class="hover:text-red-600">Sewa Lapangan</a>
            </nav>
            <div class="flex gap-3 items-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">Masuk</a>
                <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-1.5 rounded hover:bg-red-700 text-sm">Daftar</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-red-700 py-20 text-white text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">BOOKING LAPANGAN ONLINE TERBAIK</h1>
        <a href="#" class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded font-semibold transition">Daftarkan Venue →</a>
    </section>

    <!-- Filter Search -->
    <section class="bg-white dark:bg-gray-900 py-10">
        <div class="max-w-5xl mx-auto px-4 flex flex-wrap gap-4 justify-center">
            <input type="text" placeholder="Cari nama venue" class="w-full sm:w-auto px-4 py-2 border rounded-md focus:outline-none">
            <select class="w-full sm:w-auto px-4 py-2 border rounded-md">
                <option>Pilih Kota</option>
                <option>Jakarta</option>
                <option>Bandung</option>
            </select>
            <select class="w-full sm:w-auto px-4 py-2 border rounded-md">
                <option>Pilih Cabang Olahraga</option>
                <option>Futsal</option>
                <option>Badminton</option>
            </select>
            <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Cari Venue</button>
        </div>
    </section>

    <!-- Venue List -->
    <section class="bg-gray-50 dark:bg-gray-800 py-10">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-lg font-semibold mb-6">Menampilkan 614 venue tersedia</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Card venue -->
                @for ($i = 0; $i < 6; $i++)
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                        <img src="https://via.placeholder.com/400x200" alt="Venue" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-1">Nama Venue</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-300">Kota • Olahraga</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 py-6 text-center text-sm text-gray-600 dark:text-gray-400">
        &copy; {{ date('Y') }} AYO Sewa Lapangan. All rights reserved.
    </footer>

</body>
</html>

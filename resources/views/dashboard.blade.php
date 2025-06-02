<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as Admin!") }}
                </div>
            </div>
        </div>
    </div>

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
</x-app-layout>

@extends('layouts.app')
<!-- Hero Section - Matching Welcome Page Style -->
<section class="bg-light dark:bg-dark pt-10">
    <div class="container">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    PLATFORM RESMI PEMESANAN STADION SULTAN AGUNG & FASILITAS STADION
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Temukan, pesan, dan nikmati pengalaman bermain di stadion olahraga terbaik
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    </a>
                    <a href="#venue-list"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Jelajahi Sekarang
                    </a>
                </div>
            </div>
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="storage/image/stadiun.jpg" alt="mockup" class="rounded-lg shadow-md mx-auto">
            </div>
        </div>
    </div>
</section>

<!-- Search Section - Simplified Design -->
<section class="bg-light dark:bg-dark py-10">
    <div class="container">
        <div class="max-w-screen-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="flex">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama fasilitas..."
                            class="block p-4 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <button type="submit"
                            class="absolute top-0 right-0 p-4 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Venue List -->
<section id="venue-list" class="bg-light dark:bg-dark py-10">
    <div class="container">
        @if(request('search'))
        <p class="text-sm text-gray-500 mb-8 text-center">
            Hasil pencarian untuk: <span class="font-semibold">"{{ request('search') }}"</span>
        </p>
        @endif

        <div class="text-center mb-10">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                STADION <span class="text-blue-600 dark:text-blue-400"> FASILITAS</span>
            </h2>
            <p class="text-gray-500 dark:text-gray-400">{{ $stadions->count() }} berbagai macam fasilitas tersedia di
                platform kami</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($stadions as $stadion)
            <div
                class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                <a href="#">
                    <img class="rounded-t-lg h-48 w-full object-cover"
                        src="{{ $stadion->foto ? asset('storage/' . $stadion->foto) : asset('images/default-venue.jpg') }}"
                        alt="{{ $stadion->nama }}" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $stadion->nama }}</h3>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2">{{ $stadion->deskripsi }}
                    </p>
                    <div class="flex justify-between items-center mt-4">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                            {{ $stadion->lokasi }}
                        </span>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format(100000, 0, ',', '.') }}<span class="text-sm font-normal">/jam</span>
                        </span>
                    </div>
                    <a href="{{ route('penyewaan-stadion.create', ['stadion_id' => $stadion->id]) }}"
                        class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Booking Sekarang
                        <svg class="w-3.5 h-3.5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16">
                <div class="max-w-md mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-6 text-2xl font-medium text-gray-700 dark:text-white">Belum ada venue tersedia</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Silakan coba dengan kriteria pencarian yang berbeda
                        atau coba lagi nanti.</p>
                    <a href="{{ route('stadion.index') }}"
                        class="inline-flex items-center px-4 py-2 mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Refresh Halaman
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $stadions->links() }}
        </div>
    </div>
</section>

<!-- Features Section - Like Welcome Page -->
<section class="bg-light dark:bg-dark py-16">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">KEUNGGULAN KAMI</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center border border-gray-200 dark:border-gray-700 transition hover:-translate-y-2 duration-300">
                <div
                    class="mx-auto w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold dark:text-white">Terpercaya</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Platform resmi Dikpora Bantul </p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center border border-gray-200 dark:border-gray-700 transition hover:-translate-y-2 duration-300">
                <div
                    class="mx-auto w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold dark:text-white">Cepat</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Proses booking yang cepat dan mudah</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center border border-gray-200 dark:border-gray-700 transition hover:-translate-y-2 duration-300">
                <div
                    class="mx-auto w-16 h-16 bg-amber-100 dark:bg-amber-900 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold dark:text-white">Aman</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Pembayaran aman dengan berbagai metode</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center border border-gray-200 dark:border-gray-700 transition hover:-translate-y-2 duration-300">
                <div
                    class="mx-auto w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold dark:text-white">Support</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Customer service siap membantu </p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-gray-900 text-gray-400">
    <div class="container px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="md:col-span-2">
                <div class="flex items-center mb-6">
                    <x-application-logo class="h-10 w-auto text-white" />
                    <span class="ml-3 text-2xl font-bold text-white">Dikpora Bantul</span>
                </div>
                <p class="mb-6">
                    Platform Booking lapangan Stadion Sultan Agung Dan Fasilitasnya.
                </p>

                <!-- Sosial Media -->
                <div class="flex space-x-6 mt-4">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/pemkabbantul/" target="_blank" aria-label="Instagram"
                        class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 8.75a3.25 3.25 0 110 6.5 3.25 3.25 0 010-6.5zM17 6.75a.75.75 0 110 1.5.75.75 0 010-1.5zM12 10.25a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5z" />
                        </svg>
                    </a>

                    <!-- Email -->
                    <a href="mailto:publikasi@bantulkab.go.id" aria-label="Email"
                        class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="https://web.facebook.com/pemkabbantul/?locale=id_ID&_rdc=1&_rdr#" target="_blank" aria-label="Facebook"
                        class="text-gray-400 hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12a10 10 0 10-11.5 9.95v-7.05h-2.4v-2.9h2.4V9.9c0-2.4 1.43-3.74 3.63-3.74 1.05 0 2.14.18 2.14.18v2.35h-1.2c-1.18 0-1.55.74-1.55 1.5v1.8h2.64l-.42 2.9h-2.22V22A10 10 0 0022 12z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Perusahaan -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Dikpora Bantul</h3>
                <ul class="space-y-2">
                    <li><a href="https://bantulkab.go.id/" class="hover:text-white">Blog</a></li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Bantuan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white">customer service</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Dikpora Bantul. All rights reserved.</p>
        </div>
    </div>
</footer>


@section('content')
@endsection
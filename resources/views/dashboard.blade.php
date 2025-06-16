<x-app-layout>
    <!-- Hero Section - Next Level Visual Impact -->
    <section class="relative h-screen-80 flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/bg-hero.jpg') }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
        <div class="relative max-w-6xl px-6">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-white animate-fade-in-up">
                <span class="text-yellow-400">#1</span> Platform Booking Lapangan
            </h1>
            <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-3xl mx-auto animate-fade-in-up delay-100">
                Temukan, booking, dan nikmati pengalaman bermain di venue olahraga terbaik
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in-up delay-200">
                <a href="#" class="relative overflow-hidden group bg-yellow-400 hover:bg-yellow-500 text-black px-10 py-4 rounded-full font-bold shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <span class="relative z-10">Daftarkan Venue</span>
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-500"></span>
                </a>
                <a href="#venue-list" class="relative overflow-hidden group border-2 border-white text-white px-10 py-4 rounded-full font-bold transition-all duration-300 hover:bg-white/10">
                    <span class="relative z-10">Jelajahi Sekarang</span>
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-5 transition-opacity duration-500"></span>
                </a>
            </div>
        </div>
        <div class="absolute bottom-10 left-0 right-0 flex justify-center animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

<!-- Search Section - Futuristic Design -->
<section class="relative py-16 bg-white -mt-20 z-10">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100 transform -translate-y-20">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                Cari Stadion
            </h2>
    <form method="GET" action="{{ route('dashboard') }}">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-10">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari nama fasilitas..." 
                                class="w-full pl-12 pr-6 py-4 border-0 bg-gray-50 rounded-xl focus:ring-2 focus:ring-yellow-400 shadow-lg text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="h-6 w-6 absolute left-4 top-4 text-gray-400" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" 
                                class="w-full h-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-bold shadow-lg transition-all transform hover:scale-105 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="ml-2">Cari</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Venue List -->
<section id="venue-list" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        @if(request('search'))
            <p class="text-sm text-gray-500 mb-8">
                Hasil pencarian untuk: <span class="font-semibold">"{{ request('search') }}"</span>
            </p>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-2">
                    Venue <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-500">Premium</span>
                </h2>
                <p class="text-lg text-gray-600">{{ $stadions->count() }} venue tersedia di platform kami</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($stadions as $stadion)
                <div class="group relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $stadion->foto ? asset('storage/' . $stadion->foto) : asset('images/default-venue.jpg') }}" 
                             alt="{{ $stadion->nama }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex space-x-2">
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">Buka 24 Jam</span>
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">Promo</span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                            <div>
                                <h3 class="text-xl font-bold text-white">{{ $stadion->nama }}</h3>
                                <div class="flex items-center mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="ml-1 text-white font-medium">4.8</span>
                                    <span class="mx-2 text-white">•</span>
                                    <span class="text-white text-sm">200+ booking</span>
                                </div>
                            </div>
                            <span class="bg-black/30 text-white px-2 py-1 rounded text-xs">
                                {{ $stadion->lokasi }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $stadion->deskripsi }}</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-xl font-bold text-gray-900">Rp {{ number_format(100000, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/jam</span></p>
                            </div>
                            <a href="#" class="relative overflow-hidden group bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-lg font-bold shadow-lg transition-all duration-300">
                                <span class="relative z-10">Booking Sekarang</span>
                                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-6 text-2xl font-medium text-gray-700">Belum ada venue tersedia</h3>
                        <p class="mt-2 text-gray-500">Silakan coba dengan kriteria pencarian yang berbeda atau coba lagi nanti.</p>
                        <a href="{{ route('stadion.index') }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-black rounded-lg font-bold shadow-lg transition-all transform hover:scale-105">
                            Refresh Halaman
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-16 text-center">
            {{-- Pagination (jika ada) --}}
            {{ $stadions->links() }}
        </div>
    </div>
</section>


    <!-- CTA Section - Modern Gradient -->
    <section class="py-24 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Pemilik Lapangan Olahraga?</h2>
            <p class="text-xl mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan platform kami dan dapatkan lebih banyak penyewa untuk lapangan Anda!
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#" class="relative overflow-hidden group bg-yellow-400 hover:bg-yellow-500 text-black px-10 py-4 rounded-full font-bold shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <span class="relative z-10">Daftar Sekarang - Gratis</span>
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-500"></span>
                </a>
                <a href="#" class="relative overflow-hidden group border-2 border-white text-white px-10 py-4 rounded-full font-bold transition-all duration-300 hover:bg-white/10">
                    <span class="relative z-10">Pelajari Lebih Lanjut</span>
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-5 transition-opacity duration-500"></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer - Premium Dark Design -->
    <footer class="bg-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-12">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        <x-application-logo class="h-10 w-auto text-white" />
                        <span class="ml-3 text-2xl font-bold text-white">AYO Sewa</span>
                    </div>
                    <p class="mb-6">
                        Platform booking lapangan olahraga terbaik di Indonesia dengan berbagai pilihan venue berkualitas.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 3.807.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-3.807v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Perusahaan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Partner</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Bantuan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@ayosewa.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 123 4567 890</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Yogyakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-16 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; {{ date('Y') }} AYO Sewa Lapangan. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="text-sm hover:text-white transition-colors duration-300">Kebijakan Privasi</a>
                    <a href="#" class="text-sm hover:text-white transition-colors duration-300">Syarat Layanan</a>
                    <a href="#" class="text-sm hover:text-white transition-colors duration-300">Cookie</a>
                </div>
            </div>
        </div>
    </footer>
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-fade-in-up.delay-100 {
            animation-delay: 0.1s;
        }
        .animate-fade-in-up.delay-200 {
            animation-delay: 0.2s;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
        .animate-count {
            font-feature-settings: "tnum";
            font-variant-numeric: tabular-nums;
        }
    </style>

    <script>
        // Animated counter for stats
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.animate-count');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if(count < target) {
                    counter.innerText = 0;
                    const updateCount = () => {
                        const current = +counter.innerText;
                        if(current < target) {
                            counter.innerText = Math.ceil(current + increment);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                }
            });
        });
    </script>
</x-app-layout>
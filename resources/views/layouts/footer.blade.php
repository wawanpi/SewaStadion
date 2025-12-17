<footer class="bg-gray-900 text-gray-400 border-t border-gray-800">
    <div class="container px-6 py-12 mx-auto max-w-screen-xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="md:col-span-2">
                <div class="flex items-center mb-6">
                    <img src="{{ asset('storage/image/logo.jpg') }}" class="h-10 w-10 rounded-full object-cover mr-3 ring-2 ring-gray-700" alt="Logo">
                    <span class="text-2xl font-bold text-white tracking-tight">Dikpora Bantul</span>
                </div>
                <p class="mb-6 text-sm leading-relaxed max-w-sm">
                    Platform resmi pemesanan fasilitas olahraga Stadion Sultan Agung. Kami berkomitmen menyediakan layanan publik yang transparan, mudah, dan profesional.
                </p>

                <div class="flex space-x-5 mt-6">
                    <a href="https://www.instagram.com/pemkabbantul/" target="_blank" aria-label="Instagram"
                        class="text-gray-400 hover:text-amber-500 transition duration-300 transform hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 8.75a3.25 3.25 0 110 6.5 3.25 3.25 0 010-6.5zM17 6.75a.75.75 0 110 1.5.75.75 0 010-1.5zM12 10.25a1.75 1.75 0 100 3.5 1.75 1.75 0 000-3.5z" />
                        </svg>
                    </a>

                    <a href="mailto:publikasi@bantulkab.go.id" aria-label="Email"
                        class="text-gray-400 hover:text-amber-500 transition duration-300 transform hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </a>

                    <a href="https://web.facebook.com/pemkabbantul/?locale=id_ID&_rdc=1&_rdr#" target="_blank" aria-label="Facebook"
                        class="text-gray-400 hover:text-amber-500 transition duration-300 transform hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12a10 10 0 10-11.5 9.95v-7.05h-2.4v-2.9h2.4V9.9c0-2.4 1.43-3.74 3.63-3.74 1.05 0 2.14.18 2.14.18v2.35h-1.2c-1.18 0-1.55.74-1.55 1.5v1.8h2.64l-.42 2.9h-2.22V22A10 10 0 0022 12z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6 border-b border-gray-700 pb-2 inline-block">Informasi</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="https://bantulkab.go.id/" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Portal Bantul</a></li>
                    <li><a href="{{ route('stadion.index') }}" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Cek Jadwal</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Berita Terbaru</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6 border-b border-gray-700 pb-2 inline-block">Bantuan</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Customer Service</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition-colors flex items-center gap-2"><span class="text-amber-600">&rsaquo;</span> Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; {{ date('Y') }} <span class="text-amber-500 font-semibold">Dikpora Bantul</span>. All rights reserved.</p>
            <p class="mt-2 md:mt-0 text-gray-500">Designed for Public Service Excellence.</p>
        </div>
    </div>
</footer>
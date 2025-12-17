@extends('layouts.app')

@section('content')
    {{-- Hero Section: Sporty & Bold --}}
    <section class="relative bg-gradient-to-br from-green-800 to-green-700 pt-16 pb-12 overflow-hidden">
        {{-- Abstract Background Element (Overlay) --}}
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-yellow-400 rounded-full blur-3xl opacity-20"></div>

        <div class="container relative z-10">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 items-center">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-black tracking-tighter italic uppercase leading-none md:text-5xl xl:text-6xl text-white">
                        Selamat <span class="text-yellow-400">Datang</span>
                    </h1>
                    <p class="max-w-2xl mb-6 font-medium text-green-100 lg:mb-8 md:text-lg lg:text-xl border-l-4 border-yellow-400 pl-4">
                        Website Resmi Pemesanan Lapangan Stadion Sultan Agung Bantul<br>
                        <span class="text-sm opacity-80 font-normal">Pesan lapangan stadion dengan mudah, langsung dari pengelola resmi Dikpora Bantul.</span>
                    </p>
                </div>
                <div class="lg:mt-0 lg:col-span-5 lg:flex relative">
                    {{-- Image with energetic border styling --}}
                    <div class="relative rounded-2xl p-2 bg-white/10 backdrop-blur-sm border border-white/20">
                        <img src="storage/image/agung.jpg" alt="mockup" class="rounded-xl shadow-2xl transform transition hover:scale-[1.02] duration-500">
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Akhir Hero --}}

    {{-- Mengapa Memilih Kami: Bento Grid Style --}}
    <section class="bg-gray-50 dark:bg-gray-900 py-20">
        <div class="container">
            <div class="gap-12 items-start px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-12">
                
                {{-- Text Section --}}
                <div class="lg:col-span-4 self-center mb-10 lg:mb-0">
                    <h2 class="mb-4 text-4xl tracking-tight font-black text-gray-900 dark:text-white uppercase italic">
                        Why Choose <br><span class="text-green-700">Sultan Agung?</span>
                    </h2>
                    <p class="mb-6 text-gray-600 dark:text-gray-400 text-justify leading-relaxed">
                        Stadion Sultan Agung merupakan fasilitas olahraga resmi milik Dikpora Kabupaten Bantul yang
                        menyediakan layanan penyewaan lapangan berkualitas tinggi dengan standar internasional untuk
                        berbagai kegiatan olahraga dan acara.
                    </p>
                    <div class="h-1 w-20 bg-yellow-400 rounded"></div>
                </div>

                {{-- Cards Section (Unified Theme) --}}
                <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-xl border-l-4 border-green-600 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-700 transition-colors">
                                Lapangan Berkualitas
                            </h5>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-xl border-l-4 border-yellow-500 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-yellow-50 text-yellow-600 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-yellow-600 transition-colors">
                                Keamanan Terjamin
                            </h5>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-xl border-l-4 border-green-600 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-700 transition-colors">
                                Fasilitas Lengkap
                            </h5>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-xl border-l-4 border-yellow-500 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-yellow-50 text-yellow-600 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-yellow-600 transition-colors">
                                Resmi Dikpora
                            </h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- Akhir Mengapa --}}

    {{-- Layanan --}}
    <section class="bg-white dark:bg-gray-800 pt-24 pb-24 border-t border-gray-100 dark:border-gray-700">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-20">
            <div class="mb-12 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-700 text-sm font-bold tracking-wide mb-2 uppercase">Fasilitas</span>
                <h2 class="mb-4 text-4xl tracking-tight font-black text-gray-900 dark:text-white uppercase italic">Layanan Kami</h2>
                <p class="text-gray-500 dark:text-gray-400 text-lg max-w-2xl mx-auto">Fasilitas dan layanan terbaik untuk kebutuhan olahraga Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Card Template: Clean White with Top Border accent --}}
                
                {{-- 1. Penyewaan Lapangan --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-green-600 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-green-700 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Penyewaan Lapangan</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Menyediakan layanan penyewaan lapangan stadion untuk berbagai kegiatan olahraga seperti sepak bola, atletik, dan acara olahraga lainnya.</p>
                </div>

                {{-- 2. Penyelenggaraan Event --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-yellow-500 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-yellow-600 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Penyelenggaraan Event</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Menyediakan fasilitas untuk berbagai acara seperti turnamen olahraga, pertandingan, upacara, dan kegiatan komunitas.</p>
                </div>

                {{-- 3. Latihan Rutin --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-green-600 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-green-700 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Latihan Rutin</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Fasilitas ideal untuk tim olahraga, klub, dan sekolah yang membutuhkan tempat latihan rutin dengan jadwal yang fleksibel.</p>
                </div>

                {{-- 4. Area Parkir --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-yellow-500 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-yellow-600 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Area Parkir Luas</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Menyediakan area parkir yang luas dan aman untuk kendaraan pengunjung, baik mobil maupun motor.</p>
                </div>

                {{-- 5. Penerangan --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-green-600 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-green-700 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Penerangan Memadai</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Dilengkapi dengan sistem penerangan yang memadai untuk kegiatan malam hari dengan kualitas pencahayaan optimal.</p>
                </div>

                {{-- 6. Dukungan Teknis --}}
                <div class="bg-gray-50 dark:bg-gray-900 p-8 rounded-2xl border-t-8 border-yellow-500 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="flex justify-center items-center mb-6 w-16 h-16 rounded-full bg-white shadow-md text-yellow-600 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white text-center">Dukungan Teknis</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center leading-relaxed">Tim teknis yang siap membantu persiapan acara, pemasangan peralatan, dan dukungan operasional.</p>
                </div>

            </div>
        </div>
    </section>
    {{-- Akhir Layanan --}}

    {{-- Cara Pemesanan --}}
    <section class="bg-gray-50 dark:bg-black pt-24 pb-20">
        <div class="container">
            <div class="mx-auto max-w-screen-md text-center mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-black text-gray-900 dark:text-white uppercase italic">Cara Pemesanan</h2>
                <div class="w-24 h-1 bg-green-600 mx-auto rounded"></div>
            </div>
            
            <div class="grid max-w-screen-xl px-4 mx-auto lg:gap-12 lg:grid-cols-12 items-start">
                <div class="mr-auto lg:col-span-7 px-4">
                    <ol class="relative border-l-2 border-gray-200 dark:border-gray-700 space-y-10">
                        
                        {{-- Step 1 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-green-700 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 shadow-lg text-white font-bold">
                                1
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Menentukan Pemesanan</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Silakan pilih jenis fasilitas yang ingin Anda pesan, seperti Lapangan Stadion, Arena Pacuan Kuda, atau fasilitas lainnya.</p>
                        </li>

                        {{-- Step 2 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-white border-2 border-green-700 text-green-700 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 font-bold">
                                2
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Isi Form Pemesanan</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Setelah memilih fasilitas yang diinginkan, silakan isi form pemesanan. Lengkapi data diri dan tentukan spesifikasi seperti tanggal, waktu, dan durasi pemesanan.</p>
                        </li>

                        {{-- Step 3 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-green-700 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 shadow-lg text-white font-bold">
                                3
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Menunggu Konfirmasi Admin</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Setelah form dikirim, admin akan meninjau dan mengonfirmasi ketersediaan serta detail pemesanan Anda.</p>
                        </li>

                        {{-- Step 4 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-white border-2 border-green-700 text-green-700 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 font-bold">
                                4
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Pembayaran</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Jika pemesanan disetujui, Anda dapat melakukan pembayaran, lalu unggah bukti pembayaran.</p>
                        </li>

                        {{-- Step 5 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-green-700 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 shadow-lg text-white font-bold">
                                5
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Konfirmasi & Tiket</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Admin akan memverifikasi bukti pembayaran. Jika disetujui, Anda akan menerima tiket pemesanan dalam bentuk PDF.</p>
                        </li>

                        {{-- Step 6 --}}
                        <li class="ml-10">
                            <span class="absolute flex items-center justify-center w-10 h-10 bg-yellow-500 rounded-full -left-5 ring-4 ring-white dark:ring-gray-900 shadow-lg text-white font-bold">
                                6
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-bold text-gray-900 dark:text-white">Penyerahan</h3>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 text-justify">Serahkan bukti PDF ke pengawas stadion saat hari pelaksanaan.</p>
                        </li>

                    </ol>
                </div>
                
                {{-- Image with Card Style --}}
                <div class="lg:mt-0 lg:col-span-5 lg:flex sticky top-24">
                    <div class="bg-white p-2 rounded-2xl shadow-xl border border-gray-100">
                        <img src="storage\image\DENAH_STADION_SULTAN_AGUNG.png" alt="Denah Stadion" class="rounded-xl w-full">
                        <div class="p-4 text-center">
                            <span class="text-sm font-bold text-gray-500 tracking-widest uppercase">Denah Lokasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Akhir Cara Pemesanan --}}
@endsection
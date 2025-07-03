@extends('layouts.app')
@section('content')
{{-- hero --}}
<section class="bg-light dark:bg-dark pt-10">
    <div class="container">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Selamat Datang</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Website Resmi Pemesanan Lapangan Stadion Sultan Agung Bantul
                    Pesan lapangan stadion dengan mudah, langsung dari pengelola resmi Dikpora Bantul.</p>
            </div>
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="storage/image/agung.jpg" alt="mockup" class="rounded-lg shadow-md mx-auto">
            </div>
        </div>
    </div>
</section>
{{-- akhir hero --}}
{{-- mengapa --}}
<section class="bg-white dark:bg-gray-900">
    <div class="container">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-600 dark:text-gray-400 sm:text-lg">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Mengapa memilih Stadion Sultan Agung?
                </h2>
                <p class="mb-4 text-justify">
                    Stadion Sultan Agung merupakan fasilitas olahraga resmi milik Dikpora Kabupaten Bantul yang
                    menyediakan layanan penyewaan lapangan berkualitas tinggi dengan standar internasional untuk
                    berbagai kegiatan olahraga dan acara.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <!-- Card 1 -->
                <div
                    class="w-full max-w-sm bg-gradient-to-br from-green-500 to-green-600 transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-green-500/30 border border-green-200 rounded-lg">
                    <div class="flex flex-col items-center py-6 px-4">

                        <!-- Ikon selalu hitam -->
                        <div
                            class="w-16 h-16 mb-4 rounded-full flex items-center justify-center bg-gray-100 dark:bg-white/20">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <!-- Teks berubah sesuai mode -->
                        <h5 class="mb-1 text-lg font-semibold text-black dark:text-white text-center">
                            Lapangan Berkualitas
                        </h5>

                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="w-full max-w-sm bg-gradient-to-br from-blue-500 to-blue-600 transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-blue-500/30 border border-blue-200 rounded-lg">
                    <div class="flex flex-col items-center py-6 px-4">
                        <div
                            class="w-16 h-16 mb-4 rounded-full flex items-center justify-center bg-gray-100 dark:bg-white/20">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h5 class="mb-1 text-lg font-semibold text-black dark:text-white text-center">Keamanan Terjamin
                        </h5>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="w-full max-w-sm bg-gradient-to-br from-purple-500 to-purple-600 transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-purple-500/30 border border-purple-200 rounded-lg">
                    <div class="flex flex-col items-center py-6 px-4">
                        <div
                            class="w-16 h-16 mb-4 rounded-full flex items-center justify-center bg-gray-100 dark:bg-white/20">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h5 class="mb-1 text-lg font-semibold text-black dark:text-white text-center">Fasilitas Lengkap
                        </h5>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="w-full max-w-sm bg-gradient-to-br from-orange-500 to-orange-600 transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-orange-500/30 border border-orange-200 rounded-lg">
                    <div class="flex flex-col items-center py-6 px-4">
                        <div
                            class="w-16 h-16 mb-4 rounded-full flex items-center justify-center bg-gray-100 dark:bg-white/20">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h5 class="mb-1 text-lg font-semibold text-black dark:text-white text-center">Resmi Dikpora</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- akhir mengapa --}}

{{-- layanan --}}
<section class="bg-gray-50 dark:bg-gray-800 pt-24">
    <div class="py-8 px-4 mx-auto text-center max-w-screen-xl sm:py-16 lg:px-20">
        <div class="mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Layanan Kami</h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg">Fasilitas dan layanan terbaik untuk kebutuhan olahraga
                Anda</p>
        </div>
        <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:space-y-0">
            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-green-500 to-green-600 bg-gray-100 dark:bg-white/20">
                    <svg class=" w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Penyewaan Lapangan</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Menyediakan layanan penyewaan lapangan stadion
                    untuk berbagai kegiatan olahraga seperti sepak bola, atletik, dan acara olahraga lainnya dengan
                    tarif yang terjangkau.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 bg-gray-100 dark:bg-white/20">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Penyelenggaraan Event</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Menyediakan fasilitas untuk berbagai acara
                    seperti turnamen olahraga, pertandingan, upacara, dan kegiatan komunitas dengan dukungan penuh dari
                    pengelola.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 bg-gray-100 dark:bg-white/20">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Latihan Rutin</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Fasilitas ideal untuk tim olahraga, klub, dan
                    sekolah yang membutuhkan tempat latihan rutin dengan jadwal yang fleksibel dan harga khusus untuk
                    paket berlangganan.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 bg-gray-100 dark:bg-white/20">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Area Parkir Luas</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Menyediakan area parkir yang luas dan aman
                    untuk kendaraan pengunjung, baik mobil maupun motor, dengan akses yang mudah dan strategis.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 bg-gray-100 dark:bg-white/20">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Penerangan Memadai</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Dilengkapi dengan sistem penerangan yang
                    memadai untuk kegiatan malam hari, memungkinkan penggunaan stadion hingga malam dengan kualitas
                    pencahayaan yang optimal.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div
                    class="flex mx-auto justify-center items-center mb-4 w-16 h-16 rounded-full bg-gradient-to-br from-red-500 to-red-600 bg-gray-100 dark:bg-white/20">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Dukungan Teknis</h3>
                <p class="text-gray-600 dark:text-gray-400 text-justify">Tim teknis yang siap membantu persiapan acara,
                    pemasangan peralatan, dan dukungan operasional selama kegiatan berlangsung di stadion.</p>
            </div>
        </div>
    </div>
</section>
{{-- akhir layanan --}}
{{-- cara pemesanan --}}
<section class="bg-light dark:bg-dark pt-24">
    <div class="container">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-10">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Cara Pemesanan</h2>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7 px-6">
                <ol class="relative text-gray-500 border-l border-gray-200 dark:border-gray-700 dark:text-gray-400">
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            1
                        </span>
                        <h3 class="font-medium leading-tight">Menentukan Pemesanan</h3>
                        <p class="text-sm text-justify max-w-lg">Silakan pilih jenis fasilitas yang ingin Anda pesan,
                            seperti Lapangan Stadion, Arena Pacuan Kuda, atau fasilitas lainnya.</p>
                    </li>
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            2
                        </span>
                        <h3 class="font-medium leading-tight">Isi Form Pemesanan</h3>
                        <p class="text-sm text-justify max-w-lg">Setelah memilih fasilitas yang diinginkan, silakan isi
                            form pemesanan.

                            Jika Anda memilih dari katalog, lengkapi data diri dan tentukan spesifikasi seperti tanggal,
                            waktu, dan durasi pemesanan.
                        </p>
                    </li>
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            3
                        </span>
                        <h3 class="font-medium leading-tight">Menunggu Konfirmasi Admin</h3>
                        <p class="text-sm text-justify max-w-lg">Setelah form dikirim, admin akan meninjau dan
                            mengonfirmasi ketersediaan serta detail pemesanan Anda. Harap menunggu konfirmasi melalui
                            sistem.</p>
                    </li>
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            4
                        </span>
                        <h3 class="font-medium leading-tight">Pembayaran</h3>
                        <p class="text-sm text-justify max-w-lg">Jika pemesanan disetujui, Anda dapat melakukan
                            pembayaran, lalu unggah bukti pembayaran.</p>
                    </li>
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            5
                        </span>
                        <h3 class="font-medium leading-tight">Konfirmasi Pembayaran & Tiket</h3>
                        <p class="text-sm text-justify max-w-lg">Admin akan memverifikasi bukti pembayaran. Jika
                            disetujui, Anda akan menerima tiket pemesanan dalam bentuk PDF yang dapat diunduh.</p>
                    </li>
                    <li class="ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                            6
                        </span>
                        <h3 class="font-medium leading-tight">Penyerahan</h3>
                        <p class="text-sm text-justify max-w-lg">Serahkan bukti pdf ke pengawas stadion</p>
                    </li>
                </ol>
            </div>
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="storage\image\DENAH_STADION_SULTAN_AGUNG.png" alt="mockup" class="rounded-lg shadow-md mx-5000>
                </div>
            </div>
        </div>
    </section>
    {{-- akhir cara pemesanan --}}
@endsection
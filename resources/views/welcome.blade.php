@extends('layouts.app')
@section('content')
    {{-- hero --}}
    <section class="bg-light dark:bg-dark pt-10">
        <div class="container">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                       🎉 Selamat Datang</h1>
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
    <section class="bg-light dark:bg-dark">
        <div class="container">
            <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                <div class="font-light text-gray-500 sm:text-lg">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Mengapa memilih
                        kami
                        ?
                    </h2>
                    <p class="mb-4 text-justify">Ini merupakan website penyewaan resmi milik Dikpora Kabupaten Bantul, memastikan layanan yang terpercaya, efisien, dan profesional.</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div
                        class="w-full max-w-sm bg-third transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-amber-500/50 border border-gray-200 rounded dark:border-gray-700">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img class="w-24 h-24 mb-3" src="storage\image\image.png" alt="stadion" />
                            <h5 class="mb-1 text-xl font-medium text-white">Lapangan stadion terawat dan siap pakai</h5>
                        </div>
                    </div>
                    <div
                        class="w-full max-w-sm bg-third transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-amber-500/50 border border-gray-200 rounded-lg dark:border-gray-700">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img class="w-24 h-24 mb-3" src="img/mengapa/rapi.png" alt="gambar icon rapi" />
                            <h5 class="mb-1 text-xl font-medium text-white">Rapi</h5>
                        </div>
                    </div>
                    <div
                        class="w-full max-w-sm bg-third transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-amber-500/50 border border-gray-200 rounded-lg dark:border-gray-700">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img class="w-24 h-24 mb-3" src="img/mengapa/trend.png" alt="gambar icon trend" />
                            <h5 class="mb-1 text-xl font-medium text-white">Model terkini</h5>
                        </div>
                    </div>
                    <div
                        class="w-full max-w-sm bg-third transition hover:-translate-y-3 duration-300 delay-150 shadow-xl hover:shadow-amber-500/50 border border-gray-200 rounded-lg dark:border-gray-700">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img class="w-24 h-24 mb-3" src="img/mengapa/tahan.png" alt="gambar icon cepat" />
                            <h5 class="mb-1 text-xl font-medium text-white">Tahan Lama</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- akhir mengapa --}}
    {{-- layanan --}}
    <section class="bg-light dark:bg-dark pt-24">
        <div class="py-8 px-4 mx-auto text-center max-w-screen-xl sm:py-16 lg:px-20">
            <div class="mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Layanan Kami</h2>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex mx-auto justify-center items-center mb-4 w-10 h-10 rounded-full bg-five dark:bg-third lg:h-12 lg:w-12">
                        <img class="w-5 h-5 mx-auto lg:w-6 lg:h-6" src="img/layanan/custom.png" />
                    </div>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">Kustom</h3>
                    <p class="text-gray-500 text-justify">Furnitur dan dekorasi rumah dapat dipesan secara kustom untuk
                        ukurannya berdasarkan
                        katalog atau jika mempunyai referensi desain sendiri dapat mengunggah desain yang diinginkan pada
                        menu kustom</p>
                </div>
                {{-- <div>
                    <div
                        class="flex mx-auto justify-center items-center mb-4 w-10 h-10 rounded-full bg-amber-600 lg:h-12 lg:w-12">
                        <img class="w-5 h-5 mx-auto lg:w-6 lg:h-6" src="img/layanan/length.png" />
                    </div>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">Pengukuran</h3>
                    <p class="text-gray-500 text-justify">Dalam wilayah kota Purwokerto dapat dilakukan pengukuran secara
                        langsung untuk furnitur tertentu</p>
                </div> --}}
                <div>
                    <div
                        class="flex mx-auto justify-center items-center mb-4 w-10 h-10 rounded-full bg-five dark:bg-third lg:h-12 lg:w-12">
                        <img class="w-5 h-5 mx-auto lg:w-6 lg:h-6" src="img/layanan/free.png" />
                    </div>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">Pengiriman Gratis</h3>
                    <p class="text-gray-500 text-justify">Untuk wilayah Purwokerto Kota barang
                        dapat dikirim secara gratis</p>
                </div>
                <div>
                    <div
                        class="flex mx-auto justify-center items-center mb-4 w-10 h-10 rounded-full bg-five dark:bg-third lg:h-12 lg:w-12">
                        <img class="w-5 h-5 mx-auto lg:w-6 lg:h-6" src="img/layanan/consul.png" />
                    </div>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">Konsultasi Gratis</h3>
                    <p class="text-gray-500 text-justify">Jika dibutuhkan konsultasi lebih lengkap dan detail dapat
                        dilakukan komunikasi via whatsapp</p>
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
                            <p class="text-sm text-justify max-w-lg">Silakan pilih jenis fasilitas yang ingin Anda pesan, seperti Lapangan Stadion, Arena Pacuan Kuda, atau fasilitas lainnya.</p>
                        </li>
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                2
                            </span>
                            <h3 class="font-medium leading-tight">Isi Form Pemesanan</h3>
                            <p class="text-sm text-justify max-w-lg">Setelah memilih fasilitas yang diinginkan, silakan isi form pemesanan.

Jika Anda memilih dari katalog, lengkapi data diri dan tentukan spesifikasi seperti tanggal, waktu, dan durasi pemesanan.
                            </p>
                        </li>
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                3
                            </span>
                            <h3 class="font-medium leading-tight">Menunggu Konfirmasi Admin</h3>
                            <p class="text-sm text-justify max-w-lg">Setelah form dikirim, admin akan meninjau dan mengonfirmasi ketersediaan serta detail pemesanan Anda. Harap menunggu konfirmasi melalui sistem.</p>
                        </li>
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                4
                            </span>
                            <h3 class="font-medium leading-tight">Pembayaran</h3>
                            <p class="text-sm text-justify max-w-lg">Jika pemesanan disetujui, Anda dapat melakukan pembayaran, lalu unggah bukti pembayaran.</p>
                        </li>
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                                5
                            </span>
                            <h3 class="font-medium leading-tight">Konfirmasi Pembayaran & Tiket</h3>
                            <p class="text-sm text-justify max-w-lg">Admin akan memverifikasi bukti pembayaran. Jika disetujui, Anda akan menerima tiket pemesanan dalam bentuk PDF yang dapat diunduh.</p>
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
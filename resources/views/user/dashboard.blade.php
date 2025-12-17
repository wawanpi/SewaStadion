@extends('layouts.app')

@section('content')
<section class="relative bg-amber-50 dark:bg-gray-900 pt-28 pb-32 overflow-hidden">
    {{-- Decorative Blobs --}}
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-amber-200 rounded-full blur-3xl opacity-30 dark:opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-red-100 rounded-full blur-3xl opacity-30 dark:opacity-5 pointer-events-none"></div>
    
    <div class="container relative z-10 px-4 mx-auto max-w-screen-xl">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            {{-- Text Content --}}
            <div class="lg:col-span-7">
                <span class="inline-block py-1 px-3 rounded-full bg-white dark:bg-gray-800 text-amber-700 dark:text-amber-400 text-xs font-bold tracking-widest uppercase mb-6 shadow-sm border border-amber-100 dark:border-gray-700">
                    Official Platform
                </span>
                <h1 class="text-4xl md:text-5xl xl:text-6xl font-black tracking-tight text-gray-900 dark:text-white leading-[1.1] mb-6">
                    Pemesanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Stadion Sultan Agung</span> & Fasilitas Resmi
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8 max-w-xl border-l-4 border-amber-500 pl-4">
                    Temukan jadwal, pesan lapangan, dan nikmati pengalaman olahraga terbaik dengan layanan terpercaya dari Pemerintah Kabupaten Bantul.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="#venue-list" class="px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-red-700 to-red-600 rounded-xl hover:from-red-800 hover:to-red-700 transition-all shadow-lg hover:shadow-red-500/30 hover:-translate-y-1">
                        Jelajahi Fasilitas
                    </a>
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="lg:col-span-5 relative group">
                <div class="absolute inset-0 bg-amber-600 rounded-2xl transform rotate-3 opacity-10 group-hover:rotate-6 transition-transform duration-500"></div>
                <img src="storage/image/stadiun.jpg" alt="Stadion Sultan Agung" class="relative rounded-2xl shadow-2xl w-full object-cover border-4 border-white dark:border-gray-700 transform transition group-hover:-translate-y-2 duration-500 aspect-video">
            </div>
        </div>
    </div>
</section>

<section class="relative -mt-16 z-20 px-4">
    <div class="container max-w-screen-lg mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari lapangan sepak bola, gedung serbaguna, dll..."
                            class="block w-full pl-12 pr-4 py-4 text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all shadow-inner">
                    </div>
                    <button type="submit" class="px-8 py-4 text-base font-bold text-white bg-gray-900 rounded-xl hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 dark:bg-amber-600 dark:hover:bg-amber-700 transition-all shadow-md w-full md:w-auto whitespace-nowrap">
                        Cari Fasilitas
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section id="venue-list" class="bg-gray-50 dark:bg-gray-900 py-24 border-t border-gray-200 dark:border-gray-800">
    <div class="container px-4 mx-auto max-w-screen-xl">
        
        @if(request('search'))
        <div class="mb-12 text-center">
            <span class="inline-block py-2 px-4 rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300 font-medium border border-amber-200 dark:border-amber-800 shadow-sm">
                🔍 Hasil pencarian untuk: <span class="font-bold">"{{ request('search') }}"</span>
            </span>
        </div>
        @endif

        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white mb-4">
                Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Fasilitas Tersedia</span>
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg">
                Menampilkan {{ $stadions->count() }} fasilitas olahraga standar nasional yang siap Anda gunakan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($stadions as $stadion)
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col h-full hover:-translate-y-1 relative">
                
                {{-- Color Bar Top --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-amber-500 to-red-600"></div>

                {{-- Image Container --}}
                <div class="relative h-56 overflow-hidden bg-gray-200 dark:bg-gray-700">
                    <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out"
                        src="{{ $stadion->foto ? asset('storage/' . $stadion->foto) : asset('images/default-venue.jpg') }}"
                        alt="{{ $stadion->nama }}" />
                    
                    {{-- Badge Harga --}}
                    <div class="absolute top-4 right-4 bg-white/95 dark:bg-gray-900/90 backdrop-blur px-3 py-1.5 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700">
                        <span class="text-sm font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format(100000, 0, ',', '.') }}
                        </span>
                        <span class="text-xs text-gray-500 font-medium">/jam</span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    {{-- Lokasi Badge --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300 border border-amber-100 dark:border-amber-800">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $stadion->lokasi }}
                        </span>
                    </div>

                    <a href="#">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-amber-600 transition-colors line-clamp-1">
                            {{ $stadion->nama }}
                        </h3>
                    </a>
                    
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 line-clamp-2 leading-relaxed flex-grow">
                        {{ $stadion->deskripsi }}
                    </p>

                    <a href="{{ route('penyewaan-stadion.create', ['stadion_id' => $stadion->id]) }}" class="mt-auto block w-full py-3 px-4 bg-gray-900 hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 text-white font-bold text-center rounded-xl transition-all shadow-md hover:shadow-lg transform active:scale-95 text-sm">
                        Booking Sekarang
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 text-center">
                <div class="inline-block p-6 rounded-full bg-white dark:bg-gray-800 mb-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Fasilitas Tidak Ditemukan</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Maaf, kami tidak dapat menemukan fasilitas dengan kata kunci tersebut.</p>
                <a href="{{ route('stadion.index') }}" class="px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg transition-colors shadow-lg">
                    Reset Pencarian
                </a>
            </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $stadions->links() }}
        </div>
    </div>
</section>

<section class="bg-white dark:bg-gray-800 py-24 border-t border-gray-100 dark:border-gray-700">
    <div class="container px-4 mx-auto max-w-screen-xl">
        <div class="text-center mb-16">
            <span class="text-amber-600 font-bold tracking-wider uppercase text-sm mb-2 block">Kenapa Memilih Kami?</span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white">Keunggulan Layanan Dikpora</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $features = [
                    ['title' => 'Terpercaya', 'desc' => 'Platform resmi pemerintah daerah Bantul.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'amber'],
                    ['title' => 'Cepat & Mudah', 'desc' => 'Proses booking online hitungan menit.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'color' => 'red'],
                    ['title' => 'Pembayaran Aman', 'desc' => 'Transaksi transparan dan terekam sistem.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'emerald'],
                    ['title' => 'Layanan Prima', 'desc' => 'Dukungan teknis siap membantu Anda.', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'blue'],
                ];
            @endphp

            @foreach($features as $f)
            <div class="group p-8 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-{{ $f['color'] }}-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-center">
                <div class="mx-auto w-14 h-14 bg-white dark:bg-gray-800 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:bg-{{ $f['color'] }}-50 transition-colors">
                    <svg class="w-7 h-7 text-{{ $f['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $f['title'] }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
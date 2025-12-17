@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-20 pt-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Page Header --}}
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 dark:text-white sm:text-4xl sm:truncate">
                    Booking Saya
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Kelola riwayat penyewaan dan unduh tiket Anda di sini.
                </p>
            </div>
            @if($bookings->count())
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('penyewaan-stadion.create') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all transform hover:-translate-y-0.5">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Booking Baru
                </a>
            </div>
            @endif
        </div>

        {{-- Session Messages --}}
        @if(session('success'))
            <div class="mb-8 rounded-xl bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                        @if(session()->has('download_link'))
                            <div class="mt-2">
                                <a href="{{ session('download_link') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download Tiket Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            @if($bookings->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fasilitas</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jadwal</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Durasi</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                {{-- Kolom Fasilitas --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                                            {{ substr($booking->stadion->nama, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $booking->stadion->nama }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center mt-0.5">
                                                <svg class="flex-shrink-0 mr-1 h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $booking->stadion->lokasi }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Jadwal --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white flex items-center">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->translatedFormat('d F Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 ml-5.5">
                                        @if($booking->slot_waktu == 1)
                                            Pagi (06:00 - 12:00)
                                        @elseif($booking->slot_waktu == 2)
                                            Siang (13:00 - 19:00)
                                        @else
                                            Full Day (00:00 - 23:59)
                                        @endif
                                    </div>
                                </td>

                                {{-- Kolom Durasi --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-100 dark:border-blue-800">
                                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $booking->durasi_hari }} Hari ({{ $booking->durasi_jam }} Jam)
                                    </span>
                                </td>

                                {{-- Kolom Status (Modern Pill) --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            'Menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dot' => 'bg-yellow-400', 'dark_bg' => 'dark:bg-yellow-900/30', 'dark_text' => 'dark:text-yellow-300'],
                                            'Diterima' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dot' => 'bg-green-400', 'dark_bg' => 'dark:bg-green-900/30', 'dark_text' => 'dark:text-green-300'],
                                            'Ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dot' => 'bg-red-400', 'dark_bg' => 'dark:bg-red-900/30', 'dark_text' => 'dark:text-red-300'],
                                            'Selesai' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'dot' => 'bg-purple-400', 'dark_bg' => 'dark:bg-purple-900/30', 'dark_text' => 'dark:text-purple-300']
                                        ];
                                        $conf = $statusConfig[$booking->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'dot' => 'bg-gray-400', 'dark_bg' => 'dark:bg-gray-700', 'dark_text' => 'dark:text-gray-300'];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $conf['bg'] }} {{ $conf['text'] }} {{ $conf['dark_bg'] }} {{ $conf['dark_text'] }}">
                                        <span class="w-2 h-2 rounded-full mr-2 {{ $conf['dot'] }}"></span>
                                        {{ $booking->status }}
                                    </span>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    @if($booking->status === 'Selesai')
                                        <a href="{{ route('penyewaan-stadion.cetak-tiket-pdf', $booking->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 border border-amber-200 dark:border-amber-700 text-xs font-medium rounded-lg text-amber-700 dark:text-amber-400 bg-white dark:bg-gray-800 hover:bg-amber-50 dark:hover:bg-gray-700 transition-colors shadow-sm"
                                           title="Download Tiket PDF">
                                            <svg class="mr-1.5 h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                                            Tiket PDF
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Menunggu Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Empty State --}}
                <div class="p-12 text-center">
                    <div class="mx-auto h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Booking</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-sm mx-auto">Anda belum pernah melakukan pemesanan fasilitas. Yuk, mulai aktivitas olahragamu sekarang!</p>
                    <a href="{{ route('penyewaan-stadion.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-lg text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transform hover:-translate-y-0.5 transition-all">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Pesanan Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
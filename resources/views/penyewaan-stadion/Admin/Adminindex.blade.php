@extends('layouts.app')

@section('content')
<div class="pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6 p-4 rounded-lg bg-gradient-to-r from-gray-800 to-gray-700 dark:from-gray-200 dark:to-gray-300 shadow-md">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <h2 class="text-2xl font-bold text-white dark:text-gray-900 mb-2 sm:mb-0">
                    {{ __('Manajemen Penyewa') }}
                </h2>
                <span class="text-sm font-medium text-gray-300 dark:text-gray-600 bg-gray-700 dark:bg-gray-200 px-3 py-1 rounded-full">
                    Total: {{ $penyewaanStadions->total() }} penyewa
                </span>
            </div>
        </div>

        <!-- Notification Panel -->
        <div class="mb-6 space-y-3">
            @foreach (['success' => 'green', 'danger' => 'red'] as $type => $color)
                @if (session($type))
                    <div x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 5000)"
                        class="p-4 rounded-lg bg-{{ $color }}-50 dark:bg-gray-800 border border-{{ $color }}-200 dark:border-{{ $color }}-800 text-{{ $color }}-700 dark:text-{{ $color }}-300">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session($type) }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Filter Card -->
        <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.penyewaan.index') }}" method="GET">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
                        <!-- Status Filter -->
                        <div class="relative w-full md:w-48">
                            <select name="status" class="block appearance-none bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 w-full">
                                <option value="Semua Status" {{ request('status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Search Input -->
                        <div class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari penyewa..." 
                                value="{{ request('search') }}"
                                class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 pl-10 pr-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 w-full">
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white py-2 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.penyewaan.index') }}" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-300 py-2 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Penyewa -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500 transition-transform hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Penyewa</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $penyewaanStadions->total() }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Menunggu -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500 transition-transform hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Menunggu</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $counts['menunggu'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Diterima -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500 transition-transform hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Diterima</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $counts['diterima'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Selesai -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-red-500 transition-transform hover:scale-[1.02]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Selesai</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $counts['selesai'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            @foreach ([
                                'ID',
                                'Penyewa',
                                'Stadion',
                                'Tanggal',
                                'Waktu',
                                'Durasi',
                                'Harga',
                                'Status',
                                'Verifikasi KTP',
                                'Bukti Bayar',
                                'Aksi'
                            ] as $th)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ $th }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($penyewaanStadions as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <!-- ID -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    #{{ $booking->id }}
                                </td>
                                
                                <!-- Penyewa -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <span class="text-gray-600 dark:text-gray-300 font-medium">
                                                {{ substr($booking->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $booking->user->name ?? '-' }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $booking->user->email ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Stadion -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $booking->stadion->nama ?? '-' }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $booking->stadion->lokasi ?? '-' }}
                                    </div>
                                </td>
                                
                                <!-- Tanggal -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->translatedFormat('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Dipesan: {{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d M Y H:i') }}
                                    </div>
                                </td>
                                
                                <!-- Waktu -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $slotLabels = [
                                            1 => 'Pagi (06:00-12:00)',
                                            2 => 'Sore (13:00-19:00)', 
                                            3 => 'Full Day (00:00-23:59)'
                                        ];
                                    @endphp
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $slotLabels[$booking->slot_waktu] ?? '-' }}
                                    </div>
                                    @if($booking->waktu_selesai)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Selesai: {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('Y-m-d H:i:s') }}
                                    </div>
                                    @endif
                                </td>
                                
                                <!-- Durasi -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-4 text-center">
                                            <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $booking->durasi_hari }}</span>
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">Hari</span>
                                        </div>
                                        <div class="text-center">
                                            <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $booking->durasi_jam }}</span>
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">Jam</span>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Harga -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Rp {{ number_format($booking->harga, 0, ',', '.') }}
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusStyles = [
                                            'Menunggu' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            'Diterima' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            'Ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            'Selesai' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusStyles[$booking->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                
                                <!-- Verifikasi KTP -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->verifikasi && Storage::disk('public')->exists($booking->verifikasi))
                                        <a href="{{ asset('storage/' . $booking->verifikasi) }}" 
                                        target="_blank" 
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors"
                                        title="Klik untuk melihat">
                                            <svg class="-ml-0.5 mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Lihat KTP
                                        </a>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="-ml-0.5 mr-1.5 h-3 w-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Belum Upload
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Bukti Pembayaran -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran))
                                        <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" 
                                        target="_blank" 
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-800 transition-colors"
                                        title="Klik untuk melihat bukti pembayaran">
                                            <svg class="-ml-0.5 mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                            </svg>
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="-ml-0.5 mr-1.5 h-3 w-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Belum Upload
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2 justify-end">
                                        @if($booking->status === 'Menunggu')
                                            <!-- Tombol Setujui -->
                                            <form action="{{ route('admin.penyewaan.approve', $booking) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors" title="Setujui">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if(in_array($booking->status, ['Menunggu', 'Diterima']))
                                            <!-- Tombol Tolak -->
                                            <form action="{{ route('admin.penyewaan.reject', $booking) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors" title="Tolak" onclick="return confirm('Yakin ingin menolak penyewaan ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status === 'Diterima')
                                            <!-- Tombol Selesai -->
                                            <form action="{{ route('penyewaan_stadion.finish', $booking) }}" method="POST" onsubmit="return confirm('Tandai sebagai selesai?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300 transition-colors" title="Selesai">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2 text-lg font-medium text-gray-600 dark:text-gray-300">Tidak ada data penyewaan</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada penyewa yang terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(method_exists($penyewaanStadions, 'hasPages') && $penyewaanStadions->hasPages())
                <div class="bg-white dark:bg-gray-800 px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                    {{ $penyewaanStadions->appends([
                        'status' => request('status'),
                        'search' => request('search')
                    ])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
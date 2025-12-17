@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-20 pt-24 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-4xl mx-auto">
        {{-- Header Section --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                Konfirmasi Pembayaran
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
                Silakan upload bukti transfer untuk menyelesaikan pemesanan Anda.
            </p>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="mb-8 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if ($booking)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                
                {{-- Header Card Gradient --}}
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Detail Tagihan
                    </h3>
                </div>

                {{-- Booking Details Grid --}}
                <div class="px-6 py-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Stadion --}}
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg text-blue-600 dark:text-blue-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-semibold">Nama Stadion</p>
                                <p class="text-base font-bold text-gray-900 dark:text-white mt-0.5">{{ $booking->stadion->nama }}</p>
                            </div>
                        </div>

                        {{-- Tanggal --}}
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg text-purple-600 dark:text-purple-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-semibold">Tanggal Sewa</p>
                                <p class="text-base font-bold text-gray-900 dark:text-white mt-0.5">{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d F Y') }}</p>
                            </div>
                        </div>

                        {{-- Kondisi/Slot --}}
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg text-indigo-600 dark:text-indigo-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-semibold">Sesi Waktu</p>
                                <p class="text-base font-bold text-gray-900 dark:text-white mt-0.5">{{ ucfirst($booking->kondisi) }}</p>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-semibold">Status Pesanan</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 mt-1">
                                    {{ $booking->status }}
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- Total Harga Highlight --}}
                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pembayaran</span>
                        <span class="text-2xl font-black text-amber-600 dark:text-amber-400">Rp {{ number_format($booking->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Form Section --}}
                <div class="p-8">
                    <form action="{{ route('penyewaan.uploadBukti', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        {{-- Custom File Upload --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Upload Bukti Transfer <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer group relative">
                                <div class="space-y-1 text-center pointer-events-none">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-amber-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                        <span class="relative bg-white dark:bg-transparent rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500">
                                            <span>Upload file</span>
                                        </span>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PDF, JPG, PNG hingga 5MB</p>
                                </div>
                                <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                            </div>
                            @error('bukti_pembayaran')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Catatan --}}
                        <div>
                            <label for="catatan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Catatan Tambahan (Opsional)
                            </label>
                            <div class="mt-1">
                                <textarea id="catatan" name="catatan" rows="3" class="shadow-sm focus:ring-amber-500 focus:border-amber-500 mt-1 block w-full sm:text-sm border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white p-3" placeholder="Contoh: Transfer atas nama Budi Santoso...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl shadow-lg text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                Kirim Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-xl p-10 text-center border border-gray-100 dark:border-gray-700">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Tidak ada tagihan aktif</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Saat ini Anda tidak memiliki pemesanan yang menunggu pembayaran.</p>
                <div class="mt-6">
                    <a href="{{ route('penyewaan-stadion.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        Buat Pesanan Baru
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
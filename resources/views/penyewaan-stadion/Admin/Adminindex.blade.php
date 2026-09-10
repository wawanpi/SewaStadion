@extends('layouts.app')

@section('content')
<div class="pt-24 pb-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="md:col-span-3 bg-gradient-to-r from-gray-900 to-gray-800 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg text-white flex justify-between items-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold tracking-tight mb-1">{{ __('Manajemen Penyewa') }}</h2>
                    <p class="text-gray-400 text-sm">Kelola data penyewaan, verifikasi permohonan, dan status pembayaran.</p>
                </div>
                <div class="relative z-10 flex items-center space-x-3">
                    <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-lg text-sm font-medium border border-white/10">
                        Total: {{ $penyewaanStadions->total() }} Data
                    </span>
                </div>
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex justify-between items-center group hover:shadow-md transition-all">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Menunggu Konfirmasi</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $counts['menunggu'] ?? 0 }}</h3>
                    <div class="flex items-center mt-2 text-xs font-medium text-yellow-600 dark:text-yellow-400 bg-yellow-50 dark:bg-yellow-900/20 px-2 py-0.5 rounded w-fit">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Perlu Verifikasi
                    </div>
                </div>
                <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-2xl text-yellow-600 dark:text-yellow-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex justify-between items-center group hover:shadow-md transition-all">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Selesai / Lunas</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $counts['selesai'] ?? 0 }}</h3>
                    <div class="flex items-center mt-2 text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded w-fit">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Transaksi Berhasil
                    </div>
                </div>
                <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded-2xl text-green-600 dark:text-green-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            @foreach (['success' => 'green', 'danger' => 'red'] as $type => $color)
                @if (session($type))
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-4 text-sm text-{{ $color }}-800 border border-{{ $color }}-300 rounded-lg bg-{{ $color }}-50 dark:bg-gray-800 dark:text-{{ $color }}-400 dark:border-{{ $color }}-800 shadow-sm" role="alert">
                        <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div><span class="font-medium">{{ session($type) }}</span></div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            
            <div class="p-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50">
                <form action="{{ route('admin.penyewaan.index') }}" method="GET">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <div class="relative w-full md:w-72">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID, Nama, atau Email..." class="pl-10 pr-4 py-2.5 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm">
                            </div>

                            <div class="relative w-full md:w-48">
                                <select name="status" class="appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 py-2.5 px-4 pr-8 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 shadow-sm cursor-pointer">
                                    <option value="Semua Status" {{ request('status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <button type="submit" class="flex-1 md:flex-none items-center justify-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('admin.penyewaan.index') }}" class="flex-1 md:flex-none items-center justify-center px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors shadow-sm">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            @foreach (['ID', 'Penyewa', 'Stadion', 'Jadwal', 'Harga', 'Status', 'Dokumen Permohonan', 'Bukti Bayar', 'Aksi'] as $th)
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">
                                    {{ $th }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($penyewaanStadions as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    #{{ $booking->id }}
                                </td>
                                
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-9 w-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ substr($booking->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $booking->user->name ?? '-' }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->stadion->nama ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->stadion->lokasi ?? '-' }}</div>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center mt-0.5">
                                        @php
                                            $slots = [1 => '06:00-12:00', 2 => '13:00-19:00', 3 => 'Full Day'];
                                        @endphp
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $slots[$booking->slot_waktu] ?? '-' }}
                                        <span class="mx-1">•</span>
                                        {{ $booking->durasi_hari }} Hari
                                    </div>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                    Rp {{ number_format($booking->harga, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            'Menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500', 'border' => 'border-yellow-200'],
                                            'Diterima' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'dot' => 'bg-green-500', 'border' => 'border-green-200'],
                                            'Ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-500', 'border' => 'border-red-200'],
                                            'Selesai' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'dot' => 'bg-purple-500', 'border' => 'border-purple-200']
                                        ];
                                        $conf = $statusConfig[$booking->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500', 'border' => 'border-gray-200'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $conf['bg'] }} {{ $conf['text'] }} {{ $conf['border'] }} dark:bg-opacity-10 dark:border-opacity-20">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $conf['dot'] }}"></span>
                                        {{ $booking->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($booking->verifikasi && Storage::disk('public')->exists($booking->verifikasi))
                                        <a href="{{ asset('storage/' . $booking->verifikasi) }}" target="_blank" class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800 transition-colors" title="Lihat Surat Permohonan">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Surat
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400 italic flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Belum Upload
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran))
                                        <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800 transition-colors" title="Lihat Bukti Bayar">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400 italic flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if($booking->status === 'Menunggu')
                                            <form action="{{ route('admin.penyewaan.approve', $booking) }}" method="POST" class="inline-block">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="p-1.5 bg-green-50 text-green-600 rounded-md hover:bg-green-100 transition-colors group relative border border-green-200" title="Setujui Permohonan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if(in_array($booking->status, ['Menunggu', 'Diterima']))
                                            <form action="{{ route('admin.penyewaan.reject', $booking) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menolak penyewaan ini?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition-colors border border-red-200" title="Tolak Permohonan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status === 'Diterima')
                                            <form action="{{ route('penyewaan_stadion.finish', $booking) }}" method="POST" class="inline-block" onsubmit="return confirm('Tandai sebagai selesai?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="p-1.5 bg-purple-50 text-purple-600 rounded-md hover:bg-purple-100 transition-colors border border-purple-200" title="Selesaikan Order">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full mb-3">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tidak ada data penyewaan</h3>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Belum ada penyewaan yang sesuai dengan filter Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($penyewaanStadions, 'hasPages') && $penyewaanStadions->hasPages())
                <div class="px-5 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                    {{ $penyewaanStadions->appends(['status' => request('status'), 'search' => request('search')])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
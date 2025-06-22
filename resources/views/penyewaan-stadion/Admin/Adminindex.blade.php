<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Penyewa Stadion') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Total: {{ $penyewaanStadions->total() }} penyewa
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Filters Card -->
            <div class="mb-6 bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <select class="block appearance-none bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Semua Status</option>
                                <option>Menunggu</option>
                                <option>Diterima</option>
                                <option>Ditolak</option>
                                <option>Selesai</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Cari penyewa..." class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
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
                
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500">
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
                
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
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
                
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-red-500">
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
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
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
                                            Selesai: {{ \Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('H:i') }}
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
                                    
                                    <!-- Aksi -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <!-- View Button -->
                                            <a href="{{ route('admin.penyewaan.show', $booking) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            @if($booking->status === 'Menunggu')
                                                <!-- Approve Button -->
                                                <form action="{{ route('admin.penyewaan.approve', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Setujui">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                                <!-- Reject Button -->
                                                <form action="{{ route('admin.penyewaan.reject', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Tolak">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($booking->status === 'Diterima')
                                                <!-- Finish Button -->
                                                <form action="{{ route('penyewaan_stadion.finish', $booking) }}" method="POST" onsubmit="return confirm('Tandai sebagai selesai?')">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300" title="Selesai">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <!-- Payment Proof -->
                                            @if($booking->bukti_pembayaran)
                                                <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300" title="Bukti Pembayaran">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
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
                        {{ $penyewaanStadions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
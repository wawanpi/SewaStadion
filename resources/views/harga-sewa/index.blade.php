<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ __('Manajemen Harga Sewa') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Kelola daftar harga sewa stadion dengan mudah
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Harga Sewa</p>
                            <p class="text-2xl font-semibold">{{ $harga_sewas->total() }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-400/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Harga Terendah</p>
                            <p class="text-2xl font-semibold">
                                Rp {{ number_format($harga_sewas->min('harga') ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-green-400/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Harga Tertinggi</p>
                            <p class="text-2xl font-semibold">
                                Rp {{ number_format($harga_sewas->max('harga') ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-400/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Rata-rata Harga</p>
                            <p class="text-2xl font-semibold">
                                Rp {{ number_format($harga_sewas->avg('harga') ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-orange-400/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <!-- Search Form -->
                    <div class="w-full sm:w-96">
                        <form action="{{ route('harga-sewa.index') }}" method="GET" class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari harga sewa..." 
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                        </form>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 w-full sm:w-auto">
                        @if(request('search'))
                            <a href="{{ route('harga-sewa.index') }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </a>
                        @endif
                        <a href="{{ route('harga-sewa.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Baru
                        </a>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="px-6 pt-2 pb-4">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-3 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-100 dark:border-green-900 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('danger'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-3 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-100 dark:border-red-900 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('danger') }}
                        </div>
                    @endif
                </div>

                <!-- Table -->
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Stadion</th>
                                <th scope="col" class="px-6 py-3">Kondisi</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Keterangan</th>
                                <th scope="col" class="px-6 py-3">Terakhir Diupdate</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($harga_sewas as $harga)
                                <tr class="bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($harga->stadion->foto ?? false)
                                                <img class="w-10 h-10 rounded-md object-cover mr-3" src="{{ asset('storage/' . $harga->stadion->foto) }}" alt="{{ $harga->stadion->nama }}">
                                            @else
                                                <div class="w-10 h-10 rounded-md bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white">
                                                    {{ $harga->stadion->nama ?? '—' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $harga->stadion->lokasi ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full capitalize 
                                            @if($harga->kondisi === 'pagi-siang') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif($harga->kondisi === 'siang-sore') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @else bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300 @endif">
                                            {{ str_replace('-', ' ', $harga->kondisi) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        @if (!is_null($harga->harga))
                                            <div class="flex items-center">
                                                <span class="text-green-600 dark:text-green-400 mr-1">Rp</span>
                                                {{ number_format($harga->harga, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                Belum Ditentukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <p class="line-clamp-2 text-gray-600 dark:text-gray-300">
                                            {{ $harga->keterangan ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            <div>{{ $harga->updated_at->format('d M Y') }}</div>
                                            <div>{{ $harga->updated_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('harga-sewa.edit', $harga->id) }}" 
                                               class="p-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition"
                                               title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('harga-sewa.destroy', $harga->id) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition"
                                                        title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                                                @if(request('search'))
                                                    Tidak ditemukan harga sewa dengan kata kunci "{{ request('search') }}"
                                                @else
                                                    Belum ada data harga sewa
                                                @endif
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                @if(request('search'))
                                                    Coba dengan kata kunci lain
                                                @else
                                                    Tambahkan data harga sewa baru untuk memulai
                                                @endif
                                            </p>
                                            @if(!request('search'))
                                                <div class="mt-6">
                                                    <a href="{{ route('harga-sewa.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                                        Tambah Harga Sewa
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($harga_sewas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    {{ $harga_sewas->appends(['search' => request('search')])->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
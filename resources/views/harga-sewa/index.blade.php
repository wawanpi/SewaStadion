@extends('layouts.app')

@section('content')
<div class="pt-24 pb-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                Manajemen Harga Sewa
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Atur tarif sewa fasilitas berdasarkan sesi waktu dan kondisi tertentu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 text-white shadow-lg relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Paket Harga</p>
                    <h3 class="text-3xl font-bold">{{ $harga_sewas->total() }}</h3>
                </div>
                <div class="absolute right-0 top-0 h-full w-20 bg-white/10 transform skew-x-12 -mr-8 group-hover:-mr-6 transition-all duration-500"></div>
                <div class="absolute bottom-4 right-4 p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between group hover:border-green-200 transition-colors">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Harga Terendah</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        <span class="text-sm font-normal text-gray-400">Rp</span> {{ number_format($harga_sewas->min('harga') ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded w-fit">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    Minimum Rate
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between group hover:border-purple-200 transition-colors">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Harga Tertinggi</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        <span class="text-sm font-normal text-gray-400">Rp</span> {{ number_format($harga_sewas->max('harga') ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-purple-600 bg-purple-50 dark:bg-purple-900/20 px-2 py-1 rounded w-fit">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Maximum Rate
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-between group hover:border-orange-200 transition-colors">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-1">Rata-rata Harga</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        <span class="text-sm font-normal text-gray-400">Rp</span> {{ number_format($harga_sewas->avg('harga') ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-orange-600 bg-orange-50 dark:bg-orange-900/20 px-2 py-1 rounded w-fit">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Average
                </div>
            </div>
        </div>

        <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('harga-sewa.index') }}" method="GET" class="w-full md:w-96 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="block w-full pl-10 pr-24 py-2.5 border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                    placeholder="Cari stadion atau harga...">
                
                <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                    @if(request('search'))
                        <a href="{{ route('harga-sewa.index') }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded text-xs font-medium text-gray-500 hover:text-red-500 hover:bg-gray-100 transition-colors" title="Reset">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-200 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none transition-colors">
                        Cari
                    </button>
                </div>
            </form>

            <a href="{{ route('harga-sewa.create') }}" class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Harga Sewa
            </a>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 text-green-700 shadow-sm flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('danger'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 shadow-sm flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <span class="font-medium">{{ session('danger') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stadion</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kondisi Waktu</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga Sewa</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">Keterangan</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($harga_sewas as $harga)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                
                                {{-- Kolom Stadion (Thumbnail + Nama) --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-lg border border-gray-200 dark:border-gray-600 overflow-hidden shadow-sm">
                                            @if($harga->stadion->foto ?? false)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $harga->stadion->foto) }}" alt="{{ $harga->stadion->nama }}">
                                            @else
                                                <div class="h-full w-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                                                {{ $harga->stadion->nama ?? '—' }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                {{ $harga->stadion->lokasi ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Kondisi (Pill Badge with Icon) --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @php
                                        $conditionStyle = [
                                            'pagi-siang' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                            'siang-sore' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                            'full-day'   => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                            'malam'      => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-800', 'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z']
                                        ];
                                        $style = $conditionStyle[$harga->kondisi] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }} dark:bg-opacity-20 border border-transparent dark:border-gray-600">
                                        <svg class="mr-1.5 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $style['icon'] }}"></path></svg>
                                        {{ ucwords(str_replace('-', ' ', $harga->kondisi)) }}
                                    </span>
                                </td>

                                {{-- Kolom Harga (Highlighted) --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if (!is_null($harga->harga))
                                        <div class="text-sm font-bold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-3 py-1 rounded-lg inline-block border border-green-100 dark:border-green-800">
                                            Rp {{ number_format($harga->harga, 0, ',', '.') }}
                                        </div>
                                    @else
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-500 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                            Belum Ditentukan
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom Keterangan (Hidden Mobile) --}}
                                <td class="px-6 py-5 hidden md:table-cell max-w-xs">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate" title="{{ $harga->keterangan }}">
                                        {{ $harga->keterangan ?? '-' }}
                                    </p>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('harga-sewa.edit', $harga->id) }}" class="p-2 text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 rounded-lg dark:bg-indigo-900/30 dark:text-indigo-400 dark:hover:bg-indigo-900/50 transition-colors group relative" title="Edit Harga">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form action="{{ route('harga-sewa.destroy', $harga->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data harga ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors" title="Hapus Data">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada data harga sewa</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                                            @if(request('search'))
                                                Tidak ditemukan data dengan kata kunci "{{ request('search') }}".
                                            @else
                                                Mulai tambahkan tarif sewa untuk stadion Anda.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <div class="mt-6">
                                                <a href="{{ route('harga-sewa.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Reset Pencarian
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-6">
                                                <a href="{{ route('harga-sewa.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                    Tambah Harga Baru
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

            @if($harga_sewas->hasPages())
                <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $harga_sewas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
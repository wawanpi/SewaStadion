@extends('layouts.app')

@section('content')
<div class="pt-24 pb-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    Manajemen Stadion
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Kelola data stadion dan fasilitas olahraga yang tersedia.
                </p>
            </div>
            <div>
                <a href="{{ route('stadion.create') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Stadion Baru
                </a>
            </div>
        </div>

        <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <form action="{{ route('stadion.index') }}" method="GET" class="w-full">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full pl-10 pr-24 py-3 border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                        placeholder="Cari berdasarkan nama stadion atau lokasi...">
                    
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-200 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('stadion.index') }}" class="ml-2 inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stadion Info</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">Deskripsi</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($stadions as $stadion)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                
                                {{-- Kolom Info Utama (Gambar + Nama + Lokasi) --}}
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 relative overflow-hidden rounded-xl border border-gray-200 dark:border-gray-600 shadow-sm group-hover:shadow-md transition-shadow">
                                            @if ($stadion->foto)
                                                <img class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-500" src="{{ asset('storage/' . $stadion->foto) }}" alt="{{ $stadion->nama }}">
                                            @else
                                                <div class="h-full w-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-5">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                                                {{ $stadion->nama }}
                                            </div>
                                            <div class="flex items-center mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $stadion->lokasi }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Deskripsi (Hidden di Mobile) --}}
                                <td class="px-6 py-5 hidden md:table-cell">
                                    <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2 max-w-xs leading-relaxed">
                                        {{ $stadion->deskripsi }}
                                    </p>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('stadion.edit', $stadion) }}" class="p-2 text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 rounded-lg dark:bg-indigo-900/30 dark:text-indigo-400 dark:hover:bg-indigo-900/50 transition-colors" title="Edit Stadion">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('stadion.destroy', $stadion) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data stadion ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors" title="Hapus Stadion">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada data stadion</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                                            @if(request('search'))
                                                Tidak ditemukan stadion dengan kata kunci "{{ request('search') }}".
                                            @else
                                                Mulai tambahkan stadion pertama Anda untuk dikelola di sistem ini.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <div class="mt-6">
                                                <a href="{{ route('stadion.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Reset Pencarian
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-6">
                                                <a href="{{ route('stadion.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                    Tambah Stadion
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

            {{-- Pagination --}}
            @if($stadions->hasPages())
                <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $stadions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
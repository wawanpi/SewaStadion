@extends('layouts.app')

@section('content')
    <div class="pt-20"> <!-- Tambah padding atas lebih besar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bagian Header dengan latar belakang -->
            <div class="mb-6 p-4 rounded-lg bg-gray-800 dark:bg-gray-200 shadow-md">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <h2 class="text-2xl font-bold text-white dark:text-gray-900 mb-2 sm:mb-0">
                        {{ __('Manajemen Stadion & Fasilitas Stadion ') }}
                    </h2>
                </div>
            </div>

            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Card Header with Search and Actions -->
                <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <!-- Search Form -->
                        <div class="w-full md:w-1/2">
                            <form action="{{ route('stadion.index') }}" method="GET" class="flex items-center gap-2">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="search" 
                                        placeholder="Cari stadion..." 
                                        value="{{ request('search') }}"
                                        class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 shadow-sm transition duration-200"
                                    >
                                </div>
                                <button type="submit" class="px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 shadow-md transition duration-200 flex items-center gap-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('stadion.index') }}" class="px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500 shadow-sm transition duration-200 flex items-center gap-2">
                                        <i class="fas fa-sync-alt"></i> Reset
                                    </a>
                                @endif
                            </form>
                        </div>

                        <!-- Create Button -->
                        <a href="{{ route('stadion.create') }}" class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 shadow-md transition duration-200 flex items-center gap-2">
                            <i class="fas fa-plus mr-2"></i> Tambah Stadion
                        </a>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="px-6 pt-4">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-100 dark:border-green-900 flex items-center">
                            <i class="fas fa-check-circle mr-2 text-lg"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-100 dark:border-red-900 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2 text-lg"></i>
                            <span>{{ session('danger') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Table Container -->
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">Nama Stadion / Fasilitas</th>
                                <th scope="col" class="px-6 py-3 font-medium">Lokasi</th>
                                <th scope="col" class="px-6 py-3 font-medium">Deskripsi</th>
                                <th scope="col" class="px-6 py-3 font-medium">Foto</th>
                                <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stadions as $stadion)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <i class="fas fa-stadium text-blue-500 mr-3"></i>
                                            <span>{{ $stadion->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                            {{ $stadion->lokasi }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="line-clamp-2 text-gray-600 dark:text-gray-300">
                                            <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                                            {{ $stadion->deskripsi }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($stadion->foto)
                                            <div class="relative group">
                                                <img src="{{ asset('storage/' . $stadion->foto) }}" 
                                                    alt="{{ $stadion->nama }}"
                                                    class="w-16 h-12 object-cover rounded-lg shadow-sm group-hover:scale-105 transition duration-200">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition duration-200"></div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm flex items-center">
                                                <i class="fas fa-image mr-1"></i> No image
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end items-center space-x-3">
                                            <a href="{{ route('stadion.edit', $stadion) }}" 
                                                class="p-2 text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 rounded-lg dark:text-blue-400 dark:hover:text-white dark:bg-gray-700 dark:hover:bg-blue-600 transition duration-200"
                                                title="Edit"
                                                data-tooltip-target="tooltip-edit-{{ $stadion->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div id="tooltip-edit-{{ $stadion->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Edit
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            
                                            <form action="{{ route('stadion.destroy', $stadion) }}" method="POST" 
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus stadion ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="p-2 text-red-600 hover:text-white bg-red-50 hover:bg-red-600 rounded-lg dark:text-red-400 dark:hover:text-white dark:bg-gray-700 dark:hover:bg-red-600 transition duration-200"
                                                    title="Hapus"
                                                    data-tooltip-target="tooltip-delete-{{ $stadion->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <div id="tooltip-delete-{{ $stadion->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    Hapus
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="5" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-stadium text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                                            @if(request('search'))
                                                <p class="text-lg font-medium">Tidak ditemukan stadion dengan kata kunci "{{ request('search') }}"</p>
                                                <p class="text-sm mt-1">Coba dengan kata kunci lain</p>
                                            @else
                                                <p class="text-lg font-medium">Belum ada data stadion</p>
                                                <p class="text-sm mt-1">Tambahkan stadion baru dengan menekan tombol di atas</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($stadions->hasPages())
                <div class="p-4 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div class="text-sm text-gray-700 dark:text-gray-400">
                            Menampilkan <span class="font-medium">{{ $stadions->firstItem() }}</span> sampai <span class="font-medium">{{ $stadions->lastItem() }}</span> dari <span class="font-medium">{{ $stadions->total() }}</span> hasil
                        </div>
                        <div class="pagination">
                            {{ $stadions->appends(['search' => request('search')])->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        .transition {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>
@endsection
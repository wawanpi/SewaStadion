@extends('layouts.app')

@section('content')
    <div class="pt-16"> <!-- Added padding-top to account for fixed navbar -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header Section -->
                <div class="px-6 py-4 bg-light border-b border-gray-200 dark:bg-dark dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                            <i class="fas fa-users mr-2"></i>{{ __('Manajemen Pengguna') }}
                        </h2>
                    </div>
                </div>

                <!-- Search and Create Section -->
                <div class="p-6 bg-light dark:bg-dark border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <!-- Search Form -->
                        <div class="w-full md:w-1/2">
                            <form action="{{ route('users.index') }}" method="GET" class="flex items-center gap-2">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-blue-500 dark:text-blue-400">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="search" 
                                        placeholder="Cari pengguna..." 
                                        value="{{ request('search') }}"
                                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                </div>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                                    <i class="fas fa-filter mr-1"></i> Cari
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                                        <i class="fas fa-sync-alt mr-1"></i> Reset
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="px-6 pt-4">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-3 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-100 dark:border-green-900 flex items-center">
                            <i class="fas fa-check-circle mr-2 text-lg"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="p-3 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-100 dark:border-red-900 flex items-center">
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
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-user mr-2 text-blue-500"></i>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->role === 'admin')
                                            <span class="px-2 py-1 text-xs font-semibold text-white bg-purple-600 rounded-full">
                                                <i class="fas fa-crown mr-1"></i> Admin
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold text-white bg-blue-600 rounded-full">
                                                <i class="fas fa-user mr-1"></i> User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-end items-center space-x-2">
                                            <!-- Promote/Demote Button -->
                                                <form action="{{ route('users.toggle-admin', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 text-purple-600 hover:text-white bg-purple-50 hover:bg-purple-600 rounded-lg dark:text-purple-400 dark:hover:text-white dark:bg-gray-700 dark:hover:bg-purple-600" title="{{ $user->role === 'admin' ? 'Turunkan menjadi User' : 'Jadikan Admin' }}">
                                                    @if($user->role === 'admin')
                                                        <i class="fas fa-user-shield"></i>
                                                    @else
                                                        <i class="fas fa-user-crown"></i>
                                                    @endif
                                                </button>
                                            </form>
                                            
                                            <!-- Activate/Deactivate Button -->
                                            <form action="{{ route('users.toggle-active', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 {{ $user->is_active ? 'text-red-600 hover:text-white bg-red-50 hover:bg-red-600' : 'text-green-600 hover:text-white bg-green-50 hover:bg-green-600' }} rounded-lg dark:bg-gray-700" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    @if($user->is_active)
                                                        <i class="fas fa-user-slash"></i>
                                                    @else
                                                        <i class="fas fa-user-check"></i>
                                                    @endif
                                                </button>
                                            </form>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:text-white bg-red-50 hover:bg-red-600 rounded-lg dark:text-red-400 dark:hover:text-white dark:bg-gray-700 dark:hover:bg-red-600" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-users-slash text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                                            @if(request('search'))
                                                <p class="text-lg font-medium">Tidak ditemukan pengguna dengan kata kunci "{{ request('search') }}"</p>
                                                <p class="text-sm mt-1">Coba dengan kata kunci lain</p>
                                            @else
                                                <p class="text-lg font-medium">Belum ada data pengguna</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="p-4 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div class="text-sm text-gray-700 dark:text-gray-400">
                            Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> sampai <span class="font-medium">{{ $users->lastItem() }}</span> dari <span class="font-medium">{{ $users->total() }}</span> hasil
                        </div>
                        <div class="pagination">
                            {{ $users->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
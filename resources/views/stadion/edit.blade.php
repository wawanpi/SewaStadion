@extends('layouts.app')

@section('content')
<div class="pt-24 pb-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                Edit Stadion
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Perbarui informasi stadion dan fasilitas yang tersedia.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="p-8">
                <form method="POST" action="{{ route('stadion.update', $stadion->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="col-span-2 md:col-span-1">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Stadion</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $stadion->nama) }}" 
                                class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-4" 
                                required autofocus autocomplete="nama">
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label for="lokasi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Lokasi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $stadion->lokasi) }}" 
                                    class="block w-full pl-10 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-4" 
                                    required autocomplete="lokasi">
                            </div>
                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi Lengkap</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" 
                                class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4" 
                                required>{{ old('deskripsi', $stadion->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Foto Stadion</label>
                            
                            <div class="flex items-start space-x-6">
                                @if($stadion->foto)
                                    <div class="flex-shrink-0">
                                        <p class="text-xs text-gray-500 mb-2">Foto Saat Ini:</p>
                                        <img src="{{ asset('storage/' . $stadion->foto) }}" alt="Foto Lama" class="h-32 w-48 object-cover rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm">
                                    </div>
                                @endif

                                <div class="flex-grow">
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer group relative">
                                        <div class="space-y-1 text-center pointer-events-none">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                                <span class="font-medium text-indigo-600 hover:text-indigo-500">Upload foto baru</span>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                        <input id="foto" name="foto" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                    </div>
                                    @error('foto')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('stadion.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md transition-all transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
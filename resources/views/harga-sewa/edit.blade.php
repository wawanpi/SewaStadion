@extends('layouts.app')

@section('content')
<div class="pt-24 pb-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    Edit Harga Sewa
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui tarif dan kondisi penyewaan fasilitas.
                </p>
            </div>
            <a href="{{ route('harga-sewa.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30 flex items-center">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Formulir Perubahan Data</h3>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('harga-sewa.update', $harga_sewa->id) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="col-span-2 md:col-span-1">
                            <label for="stadion_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Stadion
                            </label>
                            <div class="relative">
                                <select id="stadion_id" name="stadion_id" class="appearance-none block w-full pl-4 pr-10 py-3 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl dark:bg-gray-700 dark:text-white transition shadow-sm" required>
                                    <option value="">-- Pilih Stadion --</option>
                                    @foreach ($stadions as $stadion)
                                        <option value="{{ $stadion->id }}" {{ old('stadion_id', $harga_sewa->stadion_id) == $stadion->id ? 'selected' : '' }}>
                                            {{ $stadion->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('stadion_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label for="kondisi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Kondisi Waktu
                            </label>
                            <div class="relative">
                                <select id="kondisi" name="kondisi" class="appearance-none block w-full pl-4 pr-10 py-3 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl dark:bg-gray-700 dark:text-white transition shadow-sm" required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="pagi-siang" {{ old('kondisi', $harga_sewa->kondisi) == 'pagi-siang' ? 'selected' : '' }}>Pagi - Siang</option>
                                    <option value="siang-sore" {{ old('kondisi', $harga_sewa->kondisi) == 'siang-sore' ? 'selected' : '' }}>Siang - Sore</option>
                                    <option value="full-day" {{ old('kondisi', $harga_sewa->kondisi) == 'full-day' ? 'selected' : '' }}>1 Hari Penuh</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('kondisi')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="harga" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Harga Sewa (Per Sesi/Hari)
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 sm:text-sm font-bold">Rp</span>
                                </div>
                                <input type="number" name="harga" id="harga" min="0" 
                                    class="block w-full pl-12 pr-4 py-3 rounded-xl border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm transition shadow-sm placeholder-gray-400" 
                                    placeholder="0" value="{{ old('harga', $harga_sewa->harga) }}">
                            </div>
                            @error('harga')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="keterangan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Keterangan Tambahan
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="4" 
                                class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4 transition placeholder-gray-400" 
                                placeholder="Jelaskan detail paket harga ini...">{{ old('keterangan', $harga_sewa->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('harga-sewa.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md transition-all transform hover:-translate-y-0.5">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const kondisiSelect = document.getElementById('kondisi');
    const keteranganTextarea = document.getElementById('keterangan');

    const keteranganDefault = {
        'pagi-siang': 'Harga berlaku untuk jam pagi hingga siang (06-12 WIB).',
        'siang-sore': 'Harga berlaku untuk jam siang hingga sore (13-18 WIB).',
        'full-day': 'Harga berlaku untuk satu hari penuh.'
    };

    kondisiSelect.addEventListener('change', function () {
        const current = keteranganTextarea.value.trim();
        const selected = this.value;
        if (!current) {
            keteranganTextarea.value = keteranganDefault[selected] || '';
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        if (kondisiSelect.value && !keteranganTextarea.value.trim()) {
            keteranganTextarea.value = keteranganDefault[kondisiSelect.value] || '';
        }
    });
</script>
@endsection
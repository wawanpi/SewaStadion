<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Harga Sewa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('harga-sewa.update', $harga_sewa->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Pilih Stadion -->
                        <div class="mb-4">
                            <x-input-label for="stadion_id" :value="__('Stadion')" />
                            <select id="stadion_id" name="stadion_id" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                                <option value="">-- Pilih Stadion --</option>
                                @foreach ($stadions as $stadion)
                                    <option value="{{ $stadion->id }}" {{ old('stadion_id', $harga_sewa->stadion_id) == $stadion->id ? 'selected' : '' }}>
                                        {{ $stadion->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('stadion_id')" />
                        </div>

                        <!-- Pilih Kondisi -->
                        <div class="mb-4">
                            <x-input-label for="kondisi" :value="__('Kondisi')" />
                            <select id="kondisi" name="kondisi" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="pagi-siang" {{ old('kondisi', $harga_sewa->kondisi) == 'pagi-siang' ? 'selected' : '' }}>Pagi - Siang</option>
                                <option value="siang-sore" {{ old('kondisi', $harga_sewa->kondisi) == 'siang-sore' ? 'selected' : '' }}>Siang - Sore</option>
                                <option value="full-day" {{ old('kondisi', $harga_sewa->kondisi) == 'full-day' ? 'selected' : '' }}>1 Hari Penuh</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kondisi')" />
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <x-input-label for="harga" :value="__('Harga (Rp)')" />
                            <x-text-input
                                id="harga"
                                name="harga"
                                type="number"
                                min="0"
                                class="mt-1 block w-full"
                                :value="old('harga', $harga_sewa->harga)"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('harga-sewa.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Harga Sewa') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12">
        <form action="{{ route('harga-sewa.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="stadion_id" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Pilih Stadion</label>
                <select name="stadion_id" id="stadion_id" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" disabled {{ old('stadion_id') ? '' : 'selected' }}>-- Pilih Stadion --</option>
                    @foreach ($stadions as $stadion)
                        <option value="{{ $stadion->id }}" {{ old('stadion_id') == $stadion->id ? 'selected' : '' }}>
                            {{ $stadion->nama }}
                        </option>
                    @endforeach
                </select>
                @error('stadion_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="kondisi" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Kondisi</label>
                <select name="kondisi" id="kondisi" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" disabled {{ old('kondisi') ? '' : 'selected' }}>-- Pilih Kondisi --</option>
                    <option value="pagi-siang" {{ old('kondisi') == 'pagi-siang' ? 'selected' : '' }}>Pagi - Siang</option>
                    <option value="siang-sore" {{ old('kondisi') == 'siang-sore' ? 'selected' : '' }}>Siang - Sore</option>
                    <option value="full-day" {{ old('kondisi') == 'full-day' ? 'selected' : '' }}>1 Hari Penuh</option>
                </select>
                @error('kondisi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Harga Sewa (Rp)</label>
                <input type="number" name="harga" id="harga" min="0" step="1000" value="{{ old('harga') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Biarkan kosong jika belum ditentukan">
                @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Keterangan harga sewa...">{{ old('keterangan') }}</textarea>
                @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>

                <a href="{{ route('harga-sewa.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        // Script otomatis isi keterangan sesuai pilihan kondisi
        const kondisiSelect = document.getElementById('kondisi');
        const keteranganTextarea = document.getElementById('keterangan');

        const keteranganDefault = {
            'pagi-siang': 'Harga berlaku untuk jam pagi hingga siang (06-12 WIB).',
            'siang-sore': 'Harga berlaku untuk jam siang hingga sore (13-18.WIB).',
            'full-day': 'Harga berlaku untuk satu hari penuh.'
        };

        kondisiSelect.addEventListener('change', function() {
            // Jika textarea kosong atau sama dengan salah satu default, isi ulang
            const current = keteranganTextarea.value.trim();
            const selected = this.value;

                if (!current) {
                    keteranganTextarea.value = keteranganDefault[selected] || '';
                }

        });

        // Trigger once on page load if ada old value kondisi tapi keterangan kosong
        document.addEventListener('DOMContentLoaded', () => {
            if (kondisiSelect.value && !keteranganTextarea.value.trim()) {
                keteranganTextarea.value = keteranganDefault[kondisiSelect.value] || '';
            }
        });
    </script>
</x-app-layout>

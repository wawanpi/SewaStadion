<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tambah Penyewaan Stadion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('penyewaan-stadion.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Stadion -->
                        <div class="mb-6">
                            <x-input-label for="stadion_id" :value="__('Pilih Stadion')" />
                            <select
                                id="stadion_id"
                                name="stadion_id"
                                required
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" >
                                <option value="" disabled selected>-- Pilih Stadion --</option>
                            @foreach ($stadion as $s)
                                <option value="{{ $s->id }}" {{ old('stadion_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('stadion_id')" />
                        </div>

                        <!-- Tanggal Sewa -->
                        <div class="mb-6">
                            <x-input-label for="tanggal_sewa" :value="__('Tanggal Sewa')" />
                            <x-text-input
                                id="tanggal_sewa"
                                name="tanggal_sewa"
                                type="date"
                                class="block w-full mt-1"
                                required
                                value="{{ old('tanggal_sewa') }}"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_sewa')" />
                        </div>

                        <!-- Durasi (hari) -->
                        <div class="mb-6">
                            <x-input-label for="durasi" :value="__('Durasi (hari)')" />
                            <x-text-input
                                id="durasi"
                                name="durasi"
                                type="number"
                                min="1"
                                class="block w-full mt-1"
                                required
                                value="{{ old('durasi') }}"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('durasi')" />
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="mb-6">
                            <x-input-label for="catatan_tambahan" :value="__('Catatan Tambahan (opsional)')" />
                            <textarea
                                id="catatan_tambahan"
                                name="catatan_tambahan"
                                rows="3"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                            >{{ old('catatan_tambahan') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('catatan_tambahan')" />
                        </div>

                        <!-- Bukti Pembayaran (bisa diupload terpisah nanti, opsional) -->
                        <div class="mb-6">
                            <x-input-label for="bukti_pembayaran" :value="__('Upload Bukti Pembayaran (opsional)')" />
                            <input
                                id="bukti_pembayaran"
                                name="bukti_pembayaran"
                                type="file"
                                accept="image/*,application/pdf"
                                class="block w-full mt-1 text-sm text-gray-900
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100
                                    dark:text-gray-100"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('bukti_pembayaran')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                            <a
                                href="{{ route('penyewaan-stadion.index') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest
                                    text-gray-700 uppercase transition duration-150 ease-in-out
                                    bg-white border border-gray-300 rounded-md shadow-sm
                                    dark:bg-gray-800 dark:border-gray-500 dark:text-gray-300
                                    hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none
                                    focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:focus:ring-offset-gray-800 disabled:opacity-25"
                            >
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

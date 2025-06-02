<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tambah Stadion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('stadion.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama stadion -->
                        <div class="mb-6">
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input
                                id="nama"
                                name="nama"
                                type="text"
                                class="block w-full mt-1"
                                required
                                autofocus
                                autocomplete="nama"
                                value="{{ old('nama') }}"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <!-- Lokasi stadion -->
                        <div class="mb-6">
                            <x-input-label for="lokasi" :value="__('Lokasi')" />
                            <x-text-input
                                id="lokasi"
                                name="lokasi"
                                type="text"
                                class="block w-full mt-1"
                                required
                                autocomplete="lokasi"
                                value="{{ old('lokasi') }}"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('lokasi')" />
                        </div>

                        <!-- Kapasitas stadion -->
                        <div class="mb-6">
                            <x-input-label for="kapasitas" :value="__('Kapasitas')" />
                            <x-text-input
                                id="kapasitas"
                                name="kapasitas"
                                type="number"
                                min="0"
                                class="block w-full mt-1"
                                required
                                autocomplete="kapasitas"
                                value="{{ old('kapasitas') }}"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('kapasitas')" />
                        </div>

                        <!-- Foto stadion -->
                        <div class="mb-6">
                            <x-input-label for="foto" :value="__('Foto Stadion')" />
                            <input
                                id="foto"
                                name="foto"
                                type="file"
                                accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-900
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                dark:text-gray-100"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                            <a
                                href="{{ route('stadion.index') }}"
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

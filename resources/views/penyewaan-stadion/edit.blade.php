<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Stadion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Edit Data Stadion') }}</h2>

                    <form method="POST" action="{{ route('stadion.update', $stadion->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Nama Stadion -->
                        <div class="mb-4">
                            <x-input-label for="nama" :value="__('Nama Stadion')" />
                            <x-text-input 
                                id="nama" 
                                name="nama" 
                                type="text" 
                                class="mt-1 block w-full"
                                :value="old('nama', $stadion->nama)" 
                                required 
                                autofocus 
                                autocomplete="nama" 
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <!-- Lokasi Stadion -->
                        <div class="mb-4">
                            <x-input-label for="lokasi" :value="__('Lokasi')" />
                            <x-text-input 
                                id="lokasi" 
                                name="lokasi" 
                                type="text" 
                                class="mt-1 block w-full"
                                :value="old('lokasi', $stadion->lokasi)" 
                                required 
                                autocomplete="lokasi" 
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('lokasi')" />
                        </div>

                        <!-- Kapasitas -->
                        <div class="mb-6">
                            <x-input-label for="kapasitas" :value="__('Kapasitas')" />
                            <x-text-input 
                                id="kapasitas" 
                                name="kapasitas" 
                                type="number" 
                                class="mt-1 block w-full"
                                :value="old('kapasitas', $stadion->kapasitas)" 
                                required 
                                autocomplete="kapasitas" 
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('kapasitas')" />
                        </div>

                        <!-- Tombol Simpan dan Batal -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('stadion.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

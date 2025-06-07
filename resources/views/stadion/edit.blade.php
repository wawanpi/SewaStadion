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

                    <form method="POST" action="{{ route('stadion.update', $stadion->id) }}" enctype="multipart/form-data">
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

                        <!-- Deskripsi Stadion -->
                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea 
                                id="deskripsi" 
                                name="deskripsi" 
                                rows="4" 
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >{{ old('deskripsi', $stadion->deskripsi) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        <!-- Foto Stadion (upload baru) -->
                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto Stadion (opsional)')" />
                            <input 
                                id="foto" 
                                name="foto" 
                                type="file" 
                                accept="image/*" 
                                class="mt-1 block w-full"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('foto')" />

                            @if($stadion->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $stadion->foto) }}" alt="Foto Stadion" class="w-40 h-auto rounded">
                                </div>
                            @endif
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

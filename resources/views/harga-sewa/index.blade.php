<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Harga Sewa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <span>List harga sewa stadion</span>
                    <a href="{{ route('harga-sewa.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                        Tambah Harga Sewa
                    </a>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Nama Stadion</th>
                                <th class="px-6 py-3">Kondisi</th>
                                <th class="px-6 py-3">Harga (Rp)</th>
                                <th class="px-6 py-3">Keterangan</th>
                                <th class="px-6 py-3">Dibuat</th>
                                <th class="px-6 py-3">Diupdate</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($harga_sewas as $harga)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $harga->id }}</td>
                                    <td class="px-6 py-4">{{ $harga->stadion->nama ?? '—' }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $harga->kondisi }}</td>
                                    <td class="px-6 py-4">
                                        @if (!is_null($harga->harga))
                                            Rp {{ number_format($harga->harga, 0, ',', '.') }}
                                        @else
                                            <span class="italic text-red-500">Belum Ditentukan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $harga->keterangan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs">{{ $harga->created_at->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-xs">{{ $harga->updated_at->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('harga-sewa.edit', $harga->id) }}"
                                           title="Edit data harga sewa"
                                           class="text-blue-600 hover:text-blue-900 font-semibold">
                                            Edit
                                        </a>
                                        <form action="{{ route('harga-sewa.destroy', $harga->id) }}" method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    title="Hapus data harga sewa"
                                                    class="text-red-600 hover:text-red-900 font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-600 dark:text-gray-300">
                                        Belum ada data harga sewa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $harga_sewas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

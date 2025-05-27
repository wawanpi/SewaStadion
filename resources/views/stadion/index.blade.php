<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stadion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('stadion.create') }}" />
                        </div>

                        @if (session('success'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 5000)"
                               class="text-sm text-green-600 dark:text-green-400">
                                {{ session('success') }}
                            </p>
                        @endif

                        @if (session('danger'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 5000)"
                               class="text-sm text-red-600 dark:text-red-400">
                                {{ session('danger') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Stadion</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stadions as $data)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('stadion.edit', $data) }}" class="hover:underline text-xs">
                                            {{ $data->nama }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        @switch($data->status)
                                            @case(0)
                                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">
                                                    Menunggu
                                                </span>
                                                @break
                                            @case(1)
                                                <span class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">
                                                    Setuju
                                                </span>
                                                @break
                                            @case(2)
                                                <span class="inline-flex items-center bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">
                                                    Ditolak
                                                </span>
                                                @break
                                            @case(3)
                                                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">
                                                    Selesai
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-gray-900 dark:text-gray-300">
                                                    Tidak diketahui
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-4">
                                            @if ($data->status == 0) {{-- Menunggu --}}
                                                <form action="{{ route('stadion.updateStatus', ['stadion' => $data->id, 'status' => 1]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 dark:text-green-400 text-xs hover:underline">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('stadion.updateStatus', ['stadion' => $data->id, 'status' => 2]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 text-xs hover:underline">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @elseif ($data->status == 1) {{-- Setuju --}}
                                                <form action="{{ route('stadion.updateStatus', ['stadion' => $data->id, 'status' => 3]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-blue-600 dark:text-blue-400 text-xs hover:underline">
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            @elseif ($data->status == 2) {{-- Ditolak --}}
                                                <form action="{{ route('stadion.updateStatus', ['stadion' => $data->id, 'status' => 0]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-600 dark:text-yellow-400 text-xs hover:underline">
                                                        Kembali ke Menunggu
                                                    </button>
                                                </form>
                                            @elseif ($data->status == 3) {{-- Selesai --}}
                                                <span class="text-gray-500 text-xs">Tidak ada aksi</span>
                                            @endif

                                            <form action="{{ route('stadion.destroy', $data) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 text-xs hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Data tidak tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

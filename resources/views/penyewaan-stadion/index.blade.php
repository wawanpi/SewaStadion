<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penyewaan Stadion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <a href="{{ route('penyewaan-stadion.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                Booking Stadion Baru
                            </a>
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
                                <th scope="col" class="px-6 py-3">User</th>
                                <th scope="col" class="px-6 py-3">Tanggal Sewa</th>
                                <th scope="col" class="px-6 py-3">Durasi (hari)</th>
                                <th scope="col" class="px-6 py-3">Catatan</th>
                                <th scope="col" class="px-6 py-3">Bukti Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyewaanStadions as $booking)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        {{ $booking->stadion->nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 dark:text-gray-300">
                                        {{ $booking->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_sewa)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 dark:text-gray-300">
                                        {{ $booking->durasi }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 dark:text-gray-300">
                                        {{ $booking->catatan_tambahan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($booking->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline text-xs">
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @switch($booking->status)
                                            @case('Menunggu')
                                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">
                                                    Menunggu
                                                </span>
                                                @break
                                            @case('Diterima')
                                                <span class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">
                                                    Diterima
                                                </span>
                                                @break
                                            @case('Ditolak')
                                                <span class="inline-flex items-center bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">
                                                    Ditolak
                                                </span>
                                                @break
                                            @case('Selesai')
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
                                    <td class="px-6 py-4 text-xs">
                                        <div class="flex flex-col gap-2">
                                            @if (auth()->user()->is_admin)
                                                {{-- Aksi admin --}}
                                                @if ($booking->status == 'Menunggu')
                                                    <form action="{{ route('penyewaan_stadion.approve', $booking) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 dark:text-green-400 hover:underline">
                                                            Terima
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('penyewaan_stadion.reject', $booking) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                {{-- Aksi user --}}
                                                @if (!$booking->bukti_pembayaran)
                                                    <a href="{{ route('penyewaan-stadion.upload_form', $booking) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                        Upload Bukti Pembayaran
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">Bukti sudah diupload</span>
                                                @endif
                                            @endif

                                            <form action="{{ route('penyewaan-stadion.destroy', $booking) }}" method="POST" onsubmit="return confirm('Yakin ingin batalkan penyewaan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data penyewaan stadion
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

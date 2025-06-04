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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Stadion</th>
                                <th class="px-4 py-2">Tanggal Sewa</th>
                                <th class="px-4 py-2">Durasi (hari)</th>
                                <th class="px-4 py-2">Slot Waktu</th>
                                <th class="px-4 py-2">Waktu Selesai</th>
                                <th class="px-4 py-2">Catatan</th>
                                <th class="px-4 py-2">Bukti Pembayaran</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penyewaanStadions as $booking)
                                <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $booking->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $booking->stadion->nama ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->tanggal_sewa)->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $booking->durasi }}</td>
                                    <td class="px-4 py-2">{{ $booking->slot_waktu ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $booking->waktu_selesai ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $booking->catatan_tambahan ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        @if ($booking->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                                        @else
                                            <span class="text-gray-400">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @switch($booking->status)
                                            @case('Menunggu') <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">Menunggu</span> @break
                                            @case('Diterima') <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Diterima</span> @break
                                            @case('Ditolak') <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Ditolak</span> @break
                                            @case('Selesai') <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-xs">Selesai</span> @break
                                            @default <span class="text-gray-500">-</span>
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex flex-col gap-1 text-xs">
                                            @if (auth()->user()->is_admin)
                                                @if ($booking->status == 'Menunggu')
                                                    <form action="{{ route('penyewaan_stadion.approve', $booking) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="text-green-600 hover:underline">Terima</button>
                                                    </form>
                                                    <form action="{{ route('penyewaan_stadion.reject', $booking) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="text-red-600 hover:underline">Tolak</button>
                                                    </form>
                                                @endif
                                            @else
                                                @if (!$booking->bukti_pembayaran)
                                                    <a href="{{ route('penyewaan-stadion.upload_form', $booking) }}" class="text-blue-600 hover:underline">
                                                        Upload Bukti
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">Sudah Upload</span>
                                                @endif
                                            @endif

                                            <form action="{{ route('penyewaan-stadion.destroy', $booking) }}" method="POST" onsubmit="return confirm('Batalkan penyewaan ini?');">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 hover:underline">Batalkan</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center py-4 text-gray-500">Tidak ada data penyewaan stadion</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

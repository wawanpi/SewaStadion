<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penyewa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Notifikasi --}}
                    @foreach (['success' => 'green', 'danger' => 'red'] as $type => $color)
                        @if (session($type))
                            <div x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="mb-4 text-sm text-{{ $color }}-600 dark:text-{{ $color }}-400">
                                {{ session($type) }}
                            </div>
                        @endif
                    @endforeach

                    {{-- Tabel --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                <tr>
                                    @foreach (['User', 'Stadion', 'Tanggal Sewa', 'Durasi', 'Slot Waktu', 'Waktu Selesai', 'Catatan', 'Harga', 'Bukti Pembayaran', 'Status', 'Aksi'] as $th)
                                        <th class="px-4 py-3">{{ $th }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($penyewaanStadions as $booking)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-4 py-3">{{ $booking->user->name ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ $booking->stadion->nama ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->tanggal_sewa)->translatedFormat('d M Y') }}</td>
                                        <td class="px-4 py-3">{{ $booking->durasi }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $slotLabels = [
                                                    1 => 'Pagi (06:00 - 12:00)',
                                                    2 => 'Sore (13:00 - 18:00)',
                                                    3 => 'Full Day (00:00 - 23:59)',
                                                ];
                                            @endphp
                                            {{ $slotLabels[$booking->slot_waktu] ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3">{{ $booking->waktu_selesai ? \Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('d M Y H:i') : '-' }}</td>
                                        <td class="px-4 py-3">{{ $booking->catatan_tambahan ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            {{ 'Rp ' . number_format($booking->harga ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($booking->bukti_pembayaran)
                                                <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                            @else
                                                <span class="text-gray-400">Belum ada</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusStyles = [
                                                    'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                                    'Diterima' => 'bg-green-100 text-green-800',
                                                    'Ditolak' => 'bg-red-100 text-red-800',
                                                    'Selesai' => 'bg-blue-100 text-blue-800',
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusStyles[$booking->status] ?? 'bg-gray-100 text-gray-600' }}">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-start flex-wrap gap-2">

                                                {{-- Setujui --}}
                                                @if($booking->status === 'Menunggu')
                                                    <form action="{{ route('admin.penyewaan.approve', $booking) }}" method="POST" title="Setujui">
                                                        @csrf @method('PATCH')
                                                        <button class="text-green-600 hover:text-green-800" type="submit">✅</button>
                                                    </form>

                                                    {{-- Tolak --}}
                                                    <form action="{{ route('admin.penyewaan.reject', $booking) }}" method="POST" title="Tolak">
                                                        @csrf @method('PATCH')
                                                        <button class="text-red-600 hover:text-red-800" type="submit">❌</button>
                                                    </form>
                                                @endif

                                                {{-- Tandai Selesai --}}
                                                @if($booking->status === 'Diterima')
                                                    <form action="{{ route('penyewaan_stadion.finish', $booking) }}" method="POST" onsubmit="return confirm('Tandai sebagai selesai?')" title="Selesai">
                                                        @csrf @method('PATCH')
                                                        <button class="text-blue-600 hover:text-blue-800" type="submit">✔️</button>
                                                    </form>
                                                @endif

                                                {{-- Upload Bukti --}}
                                                @if (!$booking->bukti_pembayaran && auth()->user()->id === $booking->user_id)
                                                    <a href="{{ route('penyewaan-stadion.upload_form', $booking) }}" title="Upload Bukti" class="text-blue-500 hover:text-blue-700">📤</a>
                                                @elseif($booking->bukti_pembayaran)
                                                    <span title="Sudah Upload" class="text-gray-400">📎</span>
                                                @endif

                                                {{-- Batalkan (hanya user penyewa yang bisa batalkan dan status belum selesai) --}}
                                                @if(auth()->user()->id === $booking->user_id && $booking->status !== 'Selesai')
                                                    <form action="{{ route('penyewaan-stadion.destroy', $booking) }}" method="POST" onsubmit="return confirm('Batalkan penyewaan ini?')" title="Batalkan">
                                                        @csrf @method('DELETE')
                                                        <button class="text-red-500 hover:text-red-700" type="submit">🗑️</button>
                                                    </form>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-gray-500 py-6">Tidak ada data penyewaan stadion.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

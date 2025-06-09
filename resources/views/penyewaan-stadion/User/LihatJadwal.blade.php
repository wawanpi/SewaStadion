<x-app-layout>


@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Jadwal Penyewaan Saya</h1>

    @if ($jadwals->isEmpty())
        <p class="text-gray-600">Belum ada penyewaan.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-2 px-4 text-left">Tanggal</th>
                        <th class="py-2 px-4 text-left">Waktu</th>
                        <th class="py-2 px-4 text-left">Status</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr class="border-t">
                            <td class="py-2 px-4">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_sewa)->format('d M Y') }}
                            </td>
                            <td class="py-2 px-4 capitalize">
                                {{-- Pastikan accessor getKondisiWaktuAttribute() ada di model PenyewaanStadion --}}
                                {{ $jadwal->kondisi_waktu ?? 'Tidak diketahui' }}
                            </td>
                            <td class="py-2 px-4">
                                @php
                                    $statusColors = [
                                        'Menunggu' => 'text-yellow-600 font-semibold',
                                        'Diterima' => 'text-green-600 font-semibold',
                                        'Ditolak' => 'text-red-600 font-semibold',
                                        'Selesai' => 'text-blue-600 font-semibold',
                                    ];
                                    $statusClass = $statusColors[$jadwal->status] ?? 'text-gray-600';
                                @endphp
                                <span class="{{ $statusClass }}">{{ $jadwal->status }}</span>
                            </td>
                            <td class="py-2 px-4">
                                @if ($jadwal->status === 'Diterima' && empty($jadwal->bukti_pembayaran))
                                    <a href="{{ route('penyewaan.upload', $jadwal->id) }}" class="text-blue-500 hover:underline">Upload Bukti</a>
                                @elseif ($jadwal->status === 'Diterima' && !empty($jadwal->bukti_pembayaran))
                                    <a href="{{ route('penyewaan.tiket', $jadwal->id) }}" class="text-green-500 hover:underline">Cetak Tiket</a>
                                @elseif ($jadwal->status === 'Ditolak')
                                    <span class="text-sm text-red-500">Pesanan ditolak</span>
                                @else
                                    <span class="text-sm text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Saya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->count())
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Stadion</th>
                            <th class="py-2 px-4 border-b">Tanggal Sewa</th>
                            <th class="py-2 px-4 border-b">Durasi (hari)</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="border-b py-2 px-4">{{ $booking->stadion->nama }}</td>
                                <td class="border-b py-2 px-4">{{ $booking->tanggal_sewa }}</td>
                                <td class="border-b py-2 px-4">{{ $booking->durasi }}</td>
                                <td class="border-b py-2 px-4">{{ $booking->status }}</td>
                                <td class="border-b py-2 px-4">
                                    <!-- Contoh tombol hapus -->
                                    <form action="{{ route('penyewaan-stadion.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin hapus booking ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Anda belum memiliki booking penyewaan stadion.</p>
            @endif
        </div>
    </div>
</x-app-layout>

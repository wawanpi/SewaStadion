<!-- resources/views/penyewaan-stadion/User/Pembayaran.blade.php -->
<x-app-layout>
    <div class="max-w-3xl mx-auto mt-6 p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Upload Bukti Pembayaran</h2>

        @if ($booking)
            <div class="mb-6 space-y-2">
                <p><strong>Nama Stadion:</strong> {{ $booking->stadion->nama }}</p>
                <p><strong>Tanggal Sewa:</strong> {{ $booking->tanggal_mulai }}</p>
                <p><strong>Kondisi:</strong> {{ ucfirst($booking->kondisi) }}</p>
                <p><strong>Total Harga:</strong> Rp{{ number_format($booking->harga, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> <span class="text-green-600 font-bold">{{ $booking->status }}</span></p>
            </div>

                <form action="{{ route('penyewaan.uploadBukti', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <div>
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran (PDF/JPG/PNG)</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="mt-1 block w-full border rounded-md p-2" required>
                    @error('bukti_pembayaran')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Tambahan (opsional)</label>
                    <textarea name="catatan" id="catatan" rows="3" class="mt-1 block w-full border rounded-md p-2">{{ old('catatan') }}</textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Kirim Bukti
                    </button>
                </div>
            </form>
        @else
            <p class="text-red-600">Tidak ada pemesanan yang diterima dan perlu dibayar saat ini.</p>
        @endif
    </div>
</x-app-layout>

<!-- resources/views/penyewaan-stadion/User/Pembayaran.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-24 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Upload Bukti Pembayaran</h2>

    @if ($booking)
        <div class="mb-6 space-y-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-800 dark:text-gray-200"><strong class="text-amber-600">Nama Stadion:</strong> {{ $booking->stadion->nama }}</p>
            <p class="text-gray-800 dark:text-gray-200"><strong class="text-amber-600">Tanggal Sewa:</strong> {{ $booking->tanggal_mulai }}</p>
            <p class="text-gray-800 dark:text-gray-200"><strong class="text-amber-600">Kondisi:</strong> {{ ucfirst($booking->kondisi) }}</p>
            <p class="text-gray-800 dark:text-gray-200"><strong class="text-amber-600">Total Harga:</strong> Rp{{ number_format($booking->harga, 0, ',', '.') }}</p>
            <p class="text-gray-800 dark:text-gray-200"><strong class="text-amber-600">Status:</strong> <span class="text-green-600 dark:text-green-400 font-bold">{{ $booking->status }}</span></p>
        </div>

        <form action="{{ route('penyewaan.uploadBukti', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            
            <div>
                <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Pembayaran (PDF/JPG/PNG)</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-amber-500 focus:border-amber-500" required>
                @error('bukti_pembayaran')
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Tambahan (opsional)</label>
                <textarea name="catatan" id="catatan" rows="3" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-amber-500 focus:border-amber-500">{{ old('catatan') }}</textarea>
            </div>

            <div>
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Kirim Bukti
                </button>
            </div>
        </form>
    @else
        <p class="text-red-600 dark:text-red-400 p-4 bg-red-50 dark:bg-gray-700 rounded-lg">Tidak ada pemesanan yang diterima dan perlu dibayar saat ini.</p>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="pt-24 pb-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    {{ __('Booking Saya') }}
                </h2>
            </div>

            @if(session('success'))
                <div class="mx-6 mt-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-200 rounded-lg">
                    <p>{{ session('success') }}</p>
                    @if(session()->has('download_link'))
                        <a href="{{ session('download_link') }}" 
                        class="mt-2 inline-flex items-center text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-green-100 font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download Tiket Sekarang
                        </a>
                    @endif
                </div>
            @endif

            @if($bookings->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stadion</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Sewa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Durasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi <span class="text-xs font-normal">(PDF)</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center text-amber-600 dark:text-amber-400 font-medium">
                                            {{ substr($booking->stadion->nama, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->stadion->nama }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $booking->stadion->lokasi }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->translatedFormat('d F Y') }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($booking->slot_waktu == 1)
                                            06:00 - 12:00
                                        @elseif($booking->slot_waktu == 2)
                                            13:00 - 19:00
                                        @else
                                            00:00 - 23:59
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                        {{ $booking->durasi_hari }} hari ({{ $booking->durasi_jam }} jam)
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'Menunggu' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300',
                                            'Diterima' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300',
                                            'Ditolak' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300',
                                            'Selesai' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300'
                                        ];
                                        $color = $statusColors[$booking->status] ?? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($booking->status === 'Selesai')
                                    <a href="{{ route('penyewaan-stadion.cetak-tiket-pdf', $booking->id) }}" 
                                    class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        PDF
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Belum ada booking</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Anda belum memiliki booking penyewaan stadion.</p>
                    <div class="mt-6">
                        <a href="{{ route('penyewaan-stadion.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800">
                            Buat Booking Baru
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
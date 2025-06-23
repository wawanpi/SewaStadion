@extends('layouts.app')

@section('content')
<div class="pt-16"> <!-- Added padding-top to account for fixed navbar -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Formulir Penyewaan Stadion</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    {{-- Flash Success --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-100 rounded">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-400 text-red-700 dark:text-red-100 rounded">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <p class="font-medium">Terdapat kesalahan dalam pengisian form:</p>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('penyewaan_stadion.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Stadion --}}
                            <div class="col-span-2">
                                <label for="stadion_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stadion</label>
                                <select name="stadion_id" id="stadion_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md shadow-sm dark:bg-gray-700 dark:text-white" required>
                                    <option value="">-- Pilih Stadion --</option>
                                    @foreach ($stadions as $stadion)
                                    <option value="{{ $stadion->id }}" 
                                        @selected(old('stadion_id', $selectedStadionId ?? null) == $stadion->id)>
                                        {{ $stadion->nama }} - {{ $stadion->lokasi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Slot Waktu --}}
                            <div>
                                <label for="slot_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Slot Waktu</label>
                                <select name="slot_waktu" id="slot_waktu" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md shadow-sm dark:bg-gray-700 dark:text-white" required>
                                    <option value="">-- Pilih Slot --</option>
                                    <option value="1" {{ old('slot_waktu') == 1 ? 'selected' : '' }}>Pagi - Siang (06:00 - 12:00)</option>
                                    <option value="2" {{ old('slot_waktu') == 2 ? 'selected' : '' }}>Siang - Sore (12:00 - 18:00)</option>
                                    <option value="3" {{ old('slot_waktu') == 3 ? 'selected' : '' }}>Full Day (00:00 - 23:59)</option>
                                </select>
                            </div>
                           {{-- Tanggal Mulai --}}
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="focus:ring-amber-500 focus:border-amber-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" required value="{{ old('tanggal_mulai') }}">
                                </div>
                            </div>

                            {{-- Durasi --}}
                            <div>
                                <label for="durasi_hari" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Durasi (hari)</label>
                                <input type="number" name="durasi_hari" id="durasi_hari" class="focus:ring-amber-500 focus:border-amber-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" min="1" value="{{ old('durasi_hari', 1) }}" required>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">* Untuk slot selain full day, hanya boleh 1 hari.</p>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Selesai</label>
                                <div class="mt-1 p-2 bg-gray-50 dark:bg-gray-700 rounded-md border border-gray-200 dark:border-gray-600">
                                    <p id="display_tanggal_selesai" class="text-sm text-gray-700 dark:text-gray-300">-</p>
                                </div>
                            </div>

                            {{-- Total Hari --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total Hari</label>
                                <div class="mt-1 p-2 bg-gray-50 dark:bg-gray-700 rounded-md border border-gray-200 dark:border-gray-600">
                                    <p id="total_hari" class="text-sm font-medium text-amber-600 dark:text-amber-400">0 hari</p>
                                </div>
                            </div>
                        </div>

                        {{-- Total Jam --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total Jam</label>
                            <div class="mt-1 p-2 bg-gray-50 dark:bg-gray-700 rounded-md border border-gray-200 dark:border-gray-600">
                                <p id="total_jam" class="text-sm font-medium text-amber-600 dark:text-amber-400">0 jam</p>
                            </div>
                        </div>

                        {{-- Catatan Tambahan --}}
                        <div>
                            <label for="catatan_tambahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan Tambahan</label>
                            <textarea name="catatan_tambahan" id="catatan_tambahan" rows="3" class="shadow-sm focus:ring-amber-500 focus:border-amber-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">{{ old('catatan_tambahan') }}</textarea>
                        </div>

                        {{-- Total Harga --}}
                        <div class="bg-amber-50 dark:bg-gray-700 p-4 rounded-md border border-amber-100 dark:border-gray-600">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Harga</span>
                                <div class="flex items-center">
                                    <span id="harga_total" class="text-xl font-bold text-amber-600 dark:text-amber-400">
                                        <span class="harga-text">Rp 0</span> 
                                        <span id="loadingHarga" class="ml-2 text-sm text-amber-400 dark:text-amber-300 hidden">(menghitung...)</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                                Ajukan Penyewaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let fp;
        let availabilityResponse = null;

        function fetchKetersediaan() {
            const stadionId = $('#stadion_id').val();
            const slotWaktu = $('#slot_waktu').val();
            
            if (!stadionId || !slotWaktu) return;

            $.ajax({
                url: '{{ route("penyewaan-stadion.ketersediaan") }}',
                method: 'GET',
                data: { 
                    stadion_id: stadionId,
                    slot_waktu: slotWaktu
                },
                success: function (response) {
                    availabilityResponse = response;
                    const fullyDisabledDates = response.fully_booked_dates;
                    const slotDisabledDates = [];
                    
                    // Cek konflik berdasarkan slot yang dipilih
                    response.partially_booked_dates.forEach(item => {
                        // Jika memilih pagi (1) dan pagi sudah dipesan
                        if (slotWaktu == 1 && item['pagi-siang']) {
                            slotDisabledDates.push(item.date);
                        } 
                        // Jika memilih sore (2) dan sore sudah dipesan
                        else if (slotWaktu == 2 && item['siang-sore']) {
                            slotDisabledDates.push(item.date);
                        }
                        // Jika memilih full day (3) dan ada booking apapun
                        else if (slotWaktu == 3 && (item['pagi-siang'] || item['siang-sore'])) {
                            slotDisabledDates.push(item.date);
                        }
                    });

                    // Gabungkan semua tanggal yang tidak bisa dipilih
                    const allDisabledDates = [...new Set([...fullyDisabledDates, ...slotDisabledDates])];
                    
                    fp.set('disable', allDisabledDates);
                    fp.redraw();
                },
                error: function(xhr) {
                    console.error('Error fetching availability:', xhr.responseText);
                }
            });
        }

        function hitungTanggalSelesai() {
            const mulai = new Date($('#tanggal_mulai').val());
            const durasi = parseInt($('#durasi_hari').val());

            if (!isNaN(mulai) && durasi > 0) {
                const selesai = new Date(mulai);
                selesai.setDate(selesai.getDate() + durasi - 1);

                const formatted = selesai.toISOString().split('T')[0];
                $('#tanggal_selesai').val(formatted);
                $('#display_tanggal_selesai').text(formatted);
                return durasi;
            }

            $('#tanggal_selesai').val('');
            $('#display_tanggal_selesai').text('-');
            return 0;
        }

       function fetchHarga() {
            const stadion_id = $('#stadion_id').val();
            const slot_waktu = $('#slot_waktu').val();
            const total_hari = hitungTanggalSelesai();

            $('#total_hari').text(total_hari + ' hari');
            $('#loadingHarga').removeClass('hidden');

            if (stadion_id && slot_waktu && total_hari > 0) {
                $.ajax({
                    url: '{{ route("penyewaan-stadion.hitung-harga") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        stadion_id: stadion_id,
                        slot_waktu: slot_waktu,
                        durasi: total_hari,
                    },
                    success: function (response) {
                        const harga = response.total_harga || 0;
                        $('.harga-text').text('Rp ' + new Intl.NumberFormat('id-ID').format(harga));
                        $('#input_harga').val(harga); // Update hidden input
                    },
                    error: function () {
                        $('.harga-text').text('Rp 0');
                        $('#input_harga').val(0);
                    },
                    complete: function () {
                        $('#loadingHarga').addClass('hidden');
                    }
                });
            } else {
                $('.harga-text').text('Rp 0');
                $('#input_harga').val(0);
                $('#loadingHarga').addClass('hidden');
            }
        }
        $(document).ready(function () {
            fp = flatpickr("#tanggal_mulai", {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr) {
                    console.log("Tanggal berubah:", dateStr); // Debugging
                    fetchHarga();
                    fetchKetersediaan();
                },
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                    
                    if (!availabilityResponse) return;
                    
                    // Reset classes first
                    dayElem.classList.remove("fully-booked", "partially-booked", "flatpickr-disabled-custom");
                    
                    // Check if date is disabled
                    if (fp.config.disable.includes(dateStr)) {
                        dayElem.classList.add("flatpickr-disabled-custom");
                        
                        // Check if fully booked
                        if (availabilityResponse.fully_booked_dates.includes(dateStr)) {
                            dayElem.classList.add("fully-booked");
                            dayElem.title = "Tanggal ini sudah penuh (full day atau kedua slot terisi)";
                        } 
                        // Check if partially booked
                        else {
                            const partialBooking = availabilityResponse.partially_booked_dates.find(item => item.date === dateStr);
                            if (partialBooking) {
                                dayElem.classList.add("partially-booked");
                                let availableSlots = [];
                                if (!partialBooking['pagi-siang']) availableSlots.push("Pagi");
                                if (!partialBooking['siang-sore']) availableSlots.push("Sore");
                                dayElem.title = "Slot tersedia: " + availableSlots.join(", ");
                            }
                        }
                    }
                }
            });

            $('#tanggal_mulai, #durasi_hari, #stadion_id, #slot_waktu').on('change', fetchHarga);
            $('#stadion_id, #slot_waktu').on('change', fetchKetersediaan);
            
            // Initialize
            fetchHarga();
            fetchKetersediaan();
        });
        function updateDurasiJam() {
            const slotWaktu = $('#slot_waktu').val();
            const durasiHari = parseInt($('#durasi_hari').val()) || 0;
            
            let jamPerHari = 0;
            switch (slotWaktu) {
                case '1': jamPerHari = 6; break; // Pagi-siang 6 jam
                case '2': jamPerHari = 6; break; // Siang-sore 6 jam (diperbaiki dari 5)
                case '3': jamPerHari = 24; break;
            }
            
            const totalJam = jamPerHari * durasiHari;
            $('#total_jam').text(totalJam + ' jam');
        }

        // Panggil fungsi ini saat slot atau durasi berubah
        $('#slot_waktu, #durasi_hari').on('change', function() {
            updateDurasiJam();
            fetchHarga();
        });

        // Panggil saat pertama kali load
        updateDurasiJam();
    </script>
@endsection
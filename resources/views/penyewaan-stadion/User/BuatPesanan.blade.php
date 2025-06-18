<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Formulir Penyewaan Stadion</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Flash Success --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
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
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
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
                                <label for="stadion_id" class="block text-sm font-medium text-gray-700 mb-1">Stadion</label>
                                <select name="stadion_id" id="stadion_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Stadion --</option>
                                    @foreach ($stadions as $stadion)
                                        <option value="{{ $stadion->id }}" {{ old('stadion_id') == $stadion->id ? 'selected' : '' }}>
                                            {{ $stadion->nama }} - {{ $stadion->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Slot Waktu --}}
                            <div>
                                <label for="slot_waktu" class="block text-sm font-medium text-gray-700 mb-1">Slot Waktu</label>
                                <select name="slot_waktu" id="slot_waktu" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Slot --</option>
                                    <option value="1" {{ old('slot_waktu') == 1 ? 'selected' : '' }}>Pagi - Siang (06:00 - 12:00)</option>
                                    <option value="2" {{ old('slot_waktu') == 2 ? 'selected' : '' }}>Siang - Sore (12:00 - 18:00)</option>
                                    <option value="3" {{ old('slot_waktu') == 3 ? 'selected' : '' }}>Full Day (00:00 - 23:59)</option>
                                </select>
                            </div>
                           {{-- Tanggal Mulai --}}
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md" required value="{{ old('tanggal_mulai') }}">
                                </div>
                            </div>

                            {{-- Durasi --}}
                            <div>
                                <label for="durasi_hari" class="block text-sm font-medium text-gray-700 mb-1">Durasi (hari)</label>
                                <input type="number" name="durasi_hari" id="durasi_hari" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md" min="1" value="{{ old('durasi_hari', 1) }}" required>
                                <p class="mt-1 text-xs text-gray-500">* Untuk slot selain full day, hanya boleh 1 hari.</p>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-md border border-gray-200">
                                    <p id="display_tanggal_selesai" class="text-sm text-gray-700">-</p>
                                </div>
                            </div>

                            {{-- Total Hari --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Total Hari</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-md border border-gray-200">
                                    <p id="total_hari" class="text-sm font-medium text-blue-600">0 hari</p>
                                </div>
                            </div>
                        </div>

                        {{-- Catatan Tambahan --}}
                        <div>
                            <label for="catatan_tambahan" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                            <textarea name="catatan_tambahan" id="catatan_tambahan" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('catatan_tambahan') }}</textarea>
                        </div>

                        {{-- Total Harga --}}
                        <div class="bg-blue-50 p-4 rounded-md border border-blue-100">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Total Harga</span>
                                <div class="flex items-center">
                                    <span id="harga_total" class="text-xl font-bold text-blue-600">
                                        <span class="harga-text">Rp 0</span> 
                                        <span id="loadingHarga" class="ml-2 text-sm text-blue-400 hidden">(menghitung...)</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
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
                    // Disable all fully booked dates
                    const disabledDates = response.fully_booked_dates;
                    
                    // Also disable dates where the specific slot is booked
                    Object.keys(response.data).forEach(date => {
                        const slots = response.data[date];
                        
                        // Full day blocks everything
                        if (slots['full-day']) {
                            disabledDates.push(date);
                            return;
                        }
                        
                        // Check for slot conflicts
                        if ((slotWaktu == 1 && slots['pagi-siang']) || 
                            (slotWaktu == 2 && slots['siang-sore'])) {
                            disabledDates.push(date);
                        }
                    });

                    // Make sure dates are unique
                    const uniqueDisabledDates = [...new Set(disabledDates)];
                    
                    fp.set('disable', uniqueDisabledDates);
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
                        const harga = response.harga || response.total_harga || 0;
                        $('.harga-text').text('Rp ' + new Intl.NumberFormat('id-ID').format(harga));
                    },
                    error: function () {
                        $('.harga-text').text('Rp 0');
                    },
                    complete: function () {
                        $('#loadingHarga').addClass('hidden');
                    }
                });
            } else {
                $('.harga-text').text('Rp 0');
                $('#loadingHarga').addClass('hidden');
            }
        }

        $(document).ready(function () {
            fp = flatpickr("#tanggal_mulai", {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr) {
                    fetchHarga();
                    fetchKetersediaan();
                },
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                    if (fp.config.disable.includes(dateStr)) {
                        dayElem.classList.add("flatpickr-disabled-custom");
                    }
                }
            });

            $('#tanggal_mulai, #durasi_hari, #stadion_id, #slot_waktu').on('change', fetchHarga);
            $('#stadion_id, #slot_waktu').on('change', fetchKetersediaan);
            
            // Initialize
            fetchHarga();
            fetchKetersediaan();
        });
    </script>

    <style>
        .flatpickr-disabled-custom {
            background-color: #fecaca !important;
            color: #991b1b !important;
            border-radius: 0.375rem;
            text-decoration: line-through;
            pointer-events: none;
        }
    </style>
</x-app-layout>
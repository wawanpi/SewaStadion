@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-20 pt-20">
    
    {{-- Header Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 dark:text-white sm:text-4xl sm:truncate">
                    Buat Pesanan Baru
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Lengkapi formulir di bawah untuk menyewa fasilitas olahraga.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Alerts Section --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl bg-green-50 p-4 border-l-4 border-green-500 shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 p-4 border-l-4 border-red-500 shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada inputan Anda:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('penyewaan_stadion.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                
                {{-- LEFT COLUMN: Form Details --}}
                <div class="col-span-2 space-y-6">
                    
                    {{-- Card: Informasi Fasilitas --}}
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 flex items-center">
                            <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pilih Fasilitas & Waktu</h3>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            {{-- Stadion Select --}}
                            <div>
                                <label for="stadion_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Fasilitas / Stadion</label>
                                <div class="relative">
                                    <select name="stadion_id" id="stadion_id" class="appearance-none block w-full pl-4 pr-10 py-3 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl dark:bg-gray-700 dark:text-white transition shadow-sm" required>
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach ($stadions as $stadion)
                                            <option value="{{ $stadion->id }}" @selected(old('stadion_id', $selectedStadionId ?? null) == $stadion->id)>
                                                {{ $stadion->nama }} - {{ $stadion->lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Slot Waktu --}}
                                <div>
                                    <label for="slot_waktu" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sesi Waktu</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <select name="slot_waktu" id="slot_waktu" class="block w-full pl-10 pr-10 py-3 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl dark:bg-gray-700 dark:text-white transition shadow-sm" required>
                                            <option value="">-- Pilih Sesi --</option>
                                            @foreach ($slots as $id => $nama)
                                                <option value="{{ $id }}" {{ old('slot_waktu') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="slot-error" class="mt-2 text-xs text-red-600 dark:text-red-400 hidden flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Harga belum diatur untuk slot ini.
                                    </div>
                                </div>

                                {{-- Durasi --}}
                                <div>
                                    <label for="durasi_hari" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Durasi (Hari)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <input type="number" name="durasi_hari" id="durasi_hari" class="block w-full pl-10 py-3 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition shadow-sm" min="1" value="{{ old('durasi_hari', 1) }}" required>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">*Slot selain full day, maks 1 hari.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Tanggal Mulai --}}
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Mulai Tanggal</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="block w-full pl-10 py-3 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition shadow-sm bg-white" required value="{{ old('tanggal_mulai') }}" placeholder="Pilih tanggal...">
                                    </div>
                                </div>

                                {{-- Tanggal Selesai (Readonly) --}}
                                <div>
                                    <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sampai Tanggal</label>
                                    <div class="w-full pl-4 py-3 bg-gray-100 dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-xl text-gray-500 dark:text-gray-300 shadow-inner flex items-center">
                                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span id="display_tanggal_selesai" class="font-medium">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card: Dokumen & Catatan --}}
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 flex items-center">
                            <div class="bg-amber-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dokumen Pendukung</h3>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="verifikasi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Upload Surat Permohonan <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer group relative">
                                    <input type="file" name="verifikasi" id="verifikasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" required>
                                    <div class="space-y-1 text-center pointer-events-none">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                            <span class="font-medium text-indigo-600 hover:text-indigo-500">Upload file</span>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX, XLS (Maks 5MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="catatan_tambahan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan_tambahan" id="catatan_tambahan" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-700 dark:text-white" placeholder="Ada permintaan khusus?">{{ old('catatan_tambahan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Summary & Pricing --}}
                <div class="col-span-1 mt-8 lg:mt-0">
                    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 sticky top-24">
                        <div class="p-6 bg-gray-900 text-white">
                            <h3 class="text-lg font-bold">Ringkasan Pesanan</h3>
                            <p class="text-gray-400 text-sm">Pastikan detail sudah benar</p>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Total Hari</span>
                                <span id="total_hari" class="font-semibold text-gray-900 dark:text-white">0 hari</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Total Durasi</span>
                                <span id="total_jam" class="font-semibold text-gray-900 dark:text-white">0 jam</span>
                            </div>
                            
                            <div class="mt-6 pt-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl p-4 text-center border border-emerald-100 dark:border-emerald-800">
                                <span class="block text-sm font-medium text-emerald-600 dark:text-emerald-400 mb-1">Total Biaya Sewa</span>
                                <span id="harga_total" class="block text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">
                                    <span class="harga-text">Rp 0</span>
                                </span>
                                <span id="loadingHarga" class="text-xs text-emerald-500 animate-pulse hidden">Menghitung...</span>
                            </div>

                            <div id="harga-error" class="text-xs text-red-600 text-center bg-red-50 p-2 rounded-lg hidden">
                                Harga sewa belum diatur.
                            </div>

                            <input type="hidden" name="harga" id="input_harga" value="0">

                            <button type="submit" id="submit-button" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" disabled>
                                AJUKAN SEKARANG
                            </button>
                            <p id="submit-tooltip" class="text-xs text-center text-gray-400 hidden">Lengkapi form untuk melanjutkan</p>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- JAVASCRIPT: TIDAK DIUBAH SAMA SEKALI --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let fp;
    let availabilityResponse = null;

    function fetchKetersediaan() {
        const stadionId = $('#stadion_id').val();
        const slotWaktu = $('#slot_waktu').val();
        
        if (!stadionId) { 
            if(fp) fp.clear();
            return;
        };

        $.ajax({
            url: '{{ route("penyewaan-stadion.ketersediaan") }}',
            method: 'GET',
            data: { 
                stadion_id: stadionId
            },
            success: function (response) {
                availabilityResponse = response;
                fp.redraw(); 
            },
            error: function(xhr) {
                console.error('Error fetching availability:', xhr.responseText);
            }
        });
    }

    function hitungTanggalSelesai() {
        const mulaiText = $('#tanggal_mulai').val();
        if(!mulaiText) return 0;

        const mulai = new Date(mulaiText);
        const durasi = parseInt($('#durasi_hari').val());

        if (!isNaN(mulai.getTime()) && durasi > 0) {
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

    function updateDurasiJam() {
        const slotWaktu = $('#slot_waktu').val();
        const durasiHari = parseInt($('#durasi_hari').val()) || 0;
        
        let jamPerHari = 0;
        switch (slotWaktu) {
            case '1': jamPerHari = 6; break;
            case '2': jamPerHari = 6; break;
            case '3': jamPerHari = 24; break;
            case '4': jamPerHari = 4; break;
        }
        
        const totalJam = jamPerHari * durasiHari;
        $('#total_jam').text(totalJam + ' jam');
    }

    function fetchHarga() {
        const stadion_id = $('#stadion_id').val();
        const slot_waktu = $('#slot_waktu').val();
        const total_hari = hitungTanggalSelesai();

        $('#total_hari').text(total_hari + ' hari');
        $('#loadingHarga').removeClass('hidden');
        $('#harga-error').addClass('hidden');
        $('#slot-error').addClass('hidden');

        const isFormValid = stadion_id && slot_waktu && total_hari > 0;
        $('#submit-button').prop('disabled', !isFormValid);
        
        if (!isFormValid) {
            $('.harga-text').text('Rp 0');
            $('#input_harga').val(0);
            $('#loadingHarga').addClass('hidden');
            return;
        }

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
                if (response.error) {
                    $('.harga-text').text('Harga belum diatur');
                    $('#input_harga').val(0);
                    $('#harga-error').removeClass('hidden');
                    $('#slot-error').removeClass('hidden');
                    $('#submit-button').prop('disabled', true)
                        .attr('title', 'Tidak bisa memesan karena harga belum diatur');
                } else {
                    const harga = response.total_harga || 0;
                    $('.harga-text').text('Rp ' + new Intl.NumberFormat('id-ID').format(harga));
                    $('#input_harga').val(harga);
                    $('#harga-error').addClass('hidden');
                    $('#slot-error').addClass('hidden');
                    $('#submit-button').prop('disabled', false)
                        .removeAttr('title');
                }
            },
            error: function (xhr) {
                $('.harga-text').text('Gagal memuat harga');
                $('#input_harga').val(0);
                $('#harga-error').removeClass('hidden');
                $('#submit-button').prop('disabled', true)
                    .attr('title', 'Tidak bisa memesan karena gagal memuat harga');
            },
            complete: function () {
                $('#loadingHarga').addClass('hidden');
            }
        });
    }

    $(document).ready(function () {
        fp = flatpickr("#tanggal_mulai", {
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                fetchHarga();
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                if (!availabilityResponse) return;
                
                const slotTerpilih = $('#slot_waktu').val();
                const infoTanggal = availabilityResponse.data[dateStr];

                dayElem.classList.remove("fully-booked", "partially-booked");
                let tooltip = '';
                let isDisabled = false;

                if (infoTanggal) {
                    if (infoTanggal['full-day'] || (infoTanggal['pagi-siang'] && infoTanggal['siang-sore'] && infoTanggal['malam'])) {
                        dayElem.classList.add("fully-booked");
                        tooltip = 'Tanggal ini sudah penuh dipesan.';
                        isDisabled = true;
                    } 
                    else if (slotTerpilih) {
                        const kondisiMapping = { '1': 'pagi-siang', '2': 'siang-sore', '3': 'full-day', '4': 'malam' };
                        const kondisiTerpilih = kondisiMapping[slotTerpilih];
                        
                        if (infoTanggal[kondisiTerpilih]) {
                            isDisabled = true;
                            tooltip = 'Slot yang Anda pilih di tanggal ini sudah dipesan.';
                        } 
                        else if (slotTerpilih == '3' && (infoTanggal['pagi-siang'] || infoTanggal['siang-sore'] || infoTanggal['malam'])) {
                            isDisabled = true;
                            tooltip = 'Tidak bisa pesan Full Day karena sebagian slot sudah terisi.';
                        }
                    }
                }

                if(isDisabled) {
                    dayElem.classList.add("flatpickr-disabled");
                }
                if(tooltip) {
                    dayElem.title = tooltip;
                }
            }
        });

        $('#tanggal_mulai, #durasi_hari, #stadion_id, #slot_waktu').on('change', function() {
            fetchHarga();
            updateDurasiJam();
        });
        
        $('#stadion_id, #slot_waktu').on('change', function() {
            fetchKetersediaan();
        });
        
        updateDurasiJam();
        fetchHarga();
        fetchKetersediaan();
    });
</script>

<style>
    .flatpickr-disabled {
        background-color: #fca5a5 !important;
        color: #7f1d1d !important;
        cursor: not-allowed;
        border-color: #f87171 !important;
    }
    .fully-booked {
        background-color: #ef4444 !important;
        color: #ffffff !important;
    }
    .partially-booked {
        background-color: #fef08a !important;
        color: #713f12 !important;
    }
    button[disabled] {
        cursor: not-allowed;
    }
    .tooltip-text {
        display: none;
    }
    button[disabled] .tooltip-text {
        display: inline;
    }
</style>
@endsection
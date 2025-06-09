<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Formulir Penyewaan Stadion</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                {{-- Flash Success --}}
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Message --}}
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('penyewaan_stadion.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Stadion --}}
                    <div class="mb-4">
                        <label for="stadion_id" class="block text-sm font-medium text-gray-700">Stadion</label>
                        <select name="stadion_id" id="stadion_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Stadion --</option>
                            @foreach ($stadions as $stadion)
                                <option value="{{ $stadion->id }}" {{ old('stadion_id') == $stadion->id ? 'selected' : '' }}>
                                    {{ $stadion->nama }} - {{ $stadion->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="mb-4">
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ old('tanggal_mulai') }}" min="{{ date('Y-m-d') }}">
                    </div>

                    {{-- Slot Waktu --}}
                    <div class="mb-4">
                        <label for="slot_waktu" class="block text-sm font-medium text-gray-700">Slot Waktu</label>
                        <select name="slot_waktu" id="slot_waktu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Slot --</option>
                            <option value="1" {{ old('slot_waktu') == 1 ? 'selected' : '' }}>Pagi - Siang (06:00 - 12:00)</option>
                            <option value="2" {{ old('slot_waktu') == 2 ? 'selected' : '' }}>Siang - Sore (12:00 - 18:00)</option>
                            <option value="3" {{ old('slot_waktu') == 3 ? 'selected' : '' }}>Full Day (00:00 - 23:59)</option>
                        </select>
                    </div>

                    {{-- Durasi --}}
                    <div class="mb-4">
                        <label for="durasi_hari" class="block text-sm font-medium text-gray-700">Durasi (hari)</label>
                        <input type="number" name="durasi_hari" id="durasi_hari" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" value="{{ old('durasi_hari', 1) }}" required>
                        <p class="text-xs text-gray-500 mt-1">* Untuk slot selain full day, hanya boleh 1 hari.</p>
                    </div>

                    {{-- Tanggal Selesai (Hidden) --}}
                    <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <p id="display_tanggal_selesai" class="text-lg font-semibold text-gray-700">-</p>
                    </div>

                    {{-- Total Hari --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Total Hari</label>
                        <p id="total_hari" class="text-lg font-semibold text-green-600">0 hari</p>
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div class="mb-4">
                        <label for="catatan_tambahan" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                        <textarea name="catatan_tambahan" id="catatan_tambahan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('catatan_tambahan') }}</textarea>
                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="mb-4">
                        <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran (Opsional)</label>
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept=".jpg,.jpeg,.png,.pdf">
                        <small class="text-gray-500">Format: JPG, PNG, PDF (maks. 5MB)</small>
                        <div id="fileError" class="text-red-600 mt-1 hidden">File terlalu besar, maksimum 5MB.</div>
                    </div>

                    {{-- Total Harga --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <p id="harga_total" class="text-lg font-semibold text-green-600">
                            <span class="harga-text">Rp 0</span> 
                            <span id="loadingHarga" class="text-sm text-gray-400 hidden">(menghitung...)</span>
                        </p>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Ajukan Penyewaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#bukti_pembayaran').on('change', function () {
            const file = this.files[0];
            if (file && file.size > 5 * 1024 * 1024) {
                $('#fileError').removeClass('hidden');
                this.value = '';
            } else {
                $('#fileError').addClass('hidden');
            }
        });

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
                        console.log('Response API:', response);
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
            $('#tanggal_mulai, #durasi_hari, #stadion_id, #slot_waktu').on('change', fetchHarga);
            fetchHarga(); // Load awal
        });
    </script>
</x-app-layout>

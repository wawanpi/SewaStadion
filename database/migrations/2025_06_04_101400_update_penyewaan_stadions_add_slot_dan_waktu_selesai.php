<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            // Ubah tanggal_sewa jadi datetime
            $table->dateTime('tanggal_sewa')->change();

            // Tambah kolom slot_waktu (1=pagi-siang, 2=siang-sore, 3=full day)
            $table->tinyInteger('slot_waktu')->after('durasi')->default(1);

            // Tambah kolom waktu_selesai nullable
            $table->dateTime('waktu_selesai')->after('slot_waktu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            // Kembalikan tanggal_sewa jadi date
            $table->date('tanggal_sewa')->change();

            // Hapus kolom yang ditambahkan
            $table->dropColumn('slot_waktu');
            $table->dropColumn('waktu_selesai');
        });
    }
};

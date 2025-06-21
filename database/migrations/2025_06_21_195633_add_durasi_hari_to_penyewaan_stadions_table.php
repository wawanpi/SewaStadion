<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            // Tambahkan durasi_jam terlebih dahulu, lalu durasi_hari
            //$table->integer('durasi_hari')->after('durasi_jam')->default(1);
        });

        // Update data lama (jika durasi masih ada, pastikan dulu kolomnya ada)
        // Jika kolom 'durasi' sudah dihapus, baris ini harus dihapus/komentar
        // DB::statement('UPDATE penyewaan_stadions SET durasi_hari = 1, durasi_jam = durasi');
    }

    public function down()
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            $table->dropColumn(['durasi_hari', 'durasi_jam']);
        });
    }
};

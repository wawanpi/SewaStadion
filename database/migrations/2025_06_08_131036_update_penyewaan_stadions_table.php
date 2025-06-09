<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            // Rename kolom hanya jika 'tanggal_sewa' masih ada
            if (Schema::hasColumn('penyewaan_stadions', 'tanggal_sewa')) {
                $table->renameColumn('tanggal_sewa', 'tanggal_mulai');
            }

            // Tambah kolom jika belum ada
            if (!Schema::hasColumn('penyewaan_stadions', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->after('tanggal_mulai');
            }

            if (!Schema::hasColumn('penyewaan_stadions', 'kondisi')) {
                $table->string('kondisi')->after('stadion_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            if (Schema::hasColumn('penyewaan_stadions', 'tanggal_mulai')) {
                $table->renameColumn('tanggal_mulai', 'tanggal_sewa');
            }

            if (Schema::hasColumn('penyewaan_stadions', 'tanggal_selesai')) {
                $table->dropColumn('tanggal_selesai');
            }

            if (Schema::hasColumn('penyewaan_stadions', 'kondisi')) {
                $table->dropColumn('kondisi');
            }
        });
    }
};

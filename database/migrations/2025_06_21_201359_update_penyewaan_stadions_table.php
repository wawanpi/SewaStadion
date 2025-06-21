<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('penyewaan_stadions', 'durasi_hari')) {
            Schema::table('penyewaan_stadions', function (Blueprint $table) {
                $table->integer('durasi_hari')->after('waktu_selesai')->default(1);
            });
        }

        if (!Schema::hasColumn('penyewaan_stadions', 'durasi_jam')) {
            Schema::table('penyewaan_stadions', function (Blueprint $table) {
                $table->integer('durasi_jam')->after('durasi_hari')->default(0);
            });
        }
    }

    public function down()
    {
        if (!Schema::hasColumn('penyewaan_stadions', 'durasi')) {
            Schema::table('penyewaan_stadions', function (Blueprint $table) {
                $table->integer('durasi')->nullable();
            });
        }

        if (Schema::hasColumn('penyewaan_stadions', 'durasi_hari')) {
            Schema::table('penyewaan_stadions', function (Blueprint $table) {
                $table->dropColumn('durasi_hari');
            });
        }

        if (Schema::hasColumn('penyewaan_stadions', 'durasi_jam')) {
            Schema::table('penyewaan_stadions', function (Blueprint $table) {
                $table->dropColumn('durasi_jam');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            $table->string('verifikasi')->nullable(); // menyimpan path file gambar verifikasi (KTP)
        });
    }

    public function down()
    {
        Schema::table('penyewaan_stadions', function (Blueprint $table) {
            $table->dropColumn('verifikasi');
        });
    }
};

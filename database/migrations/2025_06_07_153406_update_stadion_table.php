<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStadionTable extends Migration
{
    public function up()
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
            $table->dropColumn('status');
            $table->text('deskripsi')->nullable()->after('lokasi');
        });
    }

    public function down()
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->integer('kapasitas')->nullable()->after('lokasi');
            $table->string('status')->default('aktif')->after('updated_at');
            $table->dropColumn('deskripsi');
        });
    }
}

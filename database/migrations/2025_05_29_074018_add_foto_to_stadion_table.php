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
        Schema::table('stadion', function (Blueprint $table) {
            // Ganti 'deskripsi' dengan kolom yang benar-benar ada, misalnya 'kapasitas'
            $table->string('foto')->nullable()->after('kapasitas'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};

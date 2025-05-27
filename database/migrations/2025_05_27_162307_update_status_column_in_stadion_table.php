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
            $table->dropColumn('is_done');
            $table->string('status')->default('menunggu');
        });
    }

    public function down()
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->boolean('is_done')->default(false);
        });
    }

};

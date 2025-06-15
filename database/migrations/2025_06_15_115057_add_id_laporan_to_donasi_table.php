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
    Schema::table('donasi', function (Blueprint $table) {
        $table->unsignedBigInteger('id_laporan')->after('id')->nullable();

        $table->foreign('id_laporan')->references('id_laporan')->on('laporan')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('donasi', function (Blueprint $table) {
        $table->dropForeign(['id_laporan']);
        $table->dropColumn('id_laporan');
    });
}

};

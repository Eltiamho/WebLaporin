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
        Schema::create('laporan', function (Blueprint $table) {
    $table->id('id_laporan');
    $table->unsignedBigInteger('id_user');
    $table->string('judul');
    $table->string('isi');
    $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
    $table->string('lokasi');
    $table->unsignedBigInteger('instansi');
    $table->string('kategori', 50);
    $table->binary('lampiran')->nullable();
    $table->string('privasi', 50);
    $table->string('status', 50);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

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
Schema::create('instansi', function (Blueprint $table) {
    $table->id('id_instansi');
    $table->string('nama_instansi', 250);
    $table->string('Kontak', 250);
    $table->enum('status', ['Aktif', 'Nonaktif']);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};

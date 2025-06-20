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
    Schema::create('donasi', function (Blueprint $table) {
    $table->id();
    $table->string('nama')->nullable();
    $table->string('email')->nullable();
    $table->integer('jumlah')->nullable();
    $table->text('pesan')->nullable();
    $table->dateTime('tanggal')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};

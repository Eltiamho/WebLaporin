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
        Schema::create('user', function (Blueprint $table) {
    $table->id('id_user');
    $table->string('username', 50);
    $table->string('password', 255);
    $table->string('no_telp', 12)->unique();
    $table->string('email', 50)->unique();
    $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
    $table->string('alamat', 50);
    $table->enum('status_user', ['Aktif', 'Nonaktif'])->default('Aktif');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

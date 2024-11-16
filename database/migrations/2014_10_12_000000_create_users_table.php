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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama siswa
        $table->string('email')->unique(); // Email siswa
        $table->string('password'); // Password siswa
        $table->unsignedBigInteger('data_siswa_id'); // Kolom data_siswa_id
        $table->foreign('data_siswa_id')->references('id')->on('data_siswa')->onDelete('cascade'); // Relasi ke tabel data_siswa
        $table->enum('role', ['admin', 'siswa'])->default('siswa');
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

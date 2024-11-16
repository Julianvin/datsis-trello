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
        Schema::create('data_siswa', function (Blueprint $table) { // Ubah nama tabel jadi 'data_siswa'
            $table->id(); // Primary key
            $table->string('nama'); // Kolom nama, tipe data string
            $table->integer('nis')->unsigned(); // Kolom nis, tipe data integer
            $table->string('rayon'); // Kolom rayon, tipe data string
            $table->string('rombel'); // Kolom rombel, tipe data string
            $table->string('gambar');//kolom gambar
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa'); // Ubah nama tabel yang di-drop menjadi 'data_siswa'
    }
};

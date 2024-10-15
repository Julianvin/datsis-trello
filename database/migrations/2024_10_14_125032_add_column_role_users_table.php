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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role untuk menentukan apakah user adalah admin atau cashier
            //enum digunakan untuk menentukan kolom role hanya dapat memiliki nilai tertentu. nilai yang diperbolehkan adalah 'admin' dan 'cashier'.
            $table->enum('role', ['admin', 'siswa'])->default('siswa')->comment('admin untuk guru dan siswa untuk siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->enum('role', ['admin', 'siswa'])->default('siswa')->comment('admin untuk guru dan siswa untuk siswa');
        });
    }
};

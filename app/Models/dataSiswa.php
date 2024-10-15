<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'data_siswa';

    // Kolom yang boleh diisi melalui Mass Assignment
    protected $fillable = [
        'nama',
        'nis',
        'rayon',
        'rombel',
        'gambar',
    ];
}

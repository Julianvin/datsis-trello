<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\dataSiswa;

class DataSiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        dataSiswa::create([
            'nama' => 'admin',
            'nis' => 22020202,
            'rayon' => 'Rayon 6',
            'rombel' => 'Rombel A',
            'gambar' => 'public/assets/images/pfpkosong.jpeg', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

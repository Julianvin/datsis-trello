<?php

namespace App\Exports;

use App\Models\dataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class DataSiswaExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return dataSiswa::orderby('created_at', 'desc')->get();
    }

    private $rowNumber = 1;

    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama',
            'Rayon',
            'Rombel',
            'Gambar', // Menambahkan kolom untuk gambar
        ];
    }

    public function map($dataSiswa): array
    {
        return [
            $this->rowNumber++,
            $dataSiswa->nis,
            $dataSiswa->nama,
            $dataSiswa->rayon,
            $dataSiswa->rombel,
            $dataSiswa->gambar ? $this->getImagePath($dataSiswa->gambar) : null, // Menambahkan path gambar
        ];
    }

    // Fungsi untuk mendapatkan URL gambar
    private function getImagePath($filename)
    {
        return asset('storage/assets/images/' . $filename);
    }

    // Menambahkan gambar ke dalam spreadsheet
    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->rowNumber;

        for ($i = 2; $i < $rowCount; $i++) { // Mulai dari baris kedua
            $imagePath = $sheet->getCell('F' . $i)->getValue(); // Mengambil nilai gambar
            if ($imagePath) {
                $drawing = new Drawing();
                $drawing->setName('Gambar Siswa');
                $drawing->setDescription('Gambar Siswa');
                $drawing->setPath(public_path('storage/assets/images/' . basename($imagePath))); // Path ke gambar
                $drawing->setHeight(50); // Tinggi gambar
                $drawing->setCoordinates('F' . $i); // Koordinat di mana gambar akan ditambahkan
                $drawing->setWorksheet($sheet); // Menambahkan gambar ke worksheet
            }
        }
    }
}

<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\dataSiswa; // Pastikan untuk mengimpor model dataSiswa

class MonthlyStudentsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Menghitung jumlah siswa per bulan hanya untuk role 'siswa'
        $monthlyData = dataSiswa::whereHas('user', function($query) {
            $query->where('role', 'siswa'); // Ganti 'siswa' dengan nama role yang sesuai
        })
        ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Siapkan data untuk chart
        $months = [];
        $counts = [];

        foreach ($monthlyData as $data) {
            // Mengonversi nomor bulan menjadi nama bulan
            $months[] = date('F', mktime(0, 0, 0, $data->month, 1)); // Menggunakan nama bulan
            $counts[] = $data->count; // Jumlah siswa
        }

        return $this->chart->barChart()
            ->setTitle('Jumlah Siswa yang Ditambahkan per Bulan')
            ->setSubtitle('Data siswa ditambahkan sepanjang tahun')
            ->addData('Jumlah Siswa', $counts)
            ->setHeight(400)
            ->setXAxis($months);
    }
}

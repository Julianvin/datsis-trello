<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSiswa;
use App\Charts\MonthlyStudentsChart;

class LandingPageController extends Controller
{
    // Landing page utama (login)


    // Landing page untuk Admin
    public function adminLandingPage(MonthlyStudentsChart $studentsChart, Request $request)
    {
        $search = $request->input('search');

        // Filter data siswa jika ada input pencarian
        if ($search) {
            $siswa = dataSiswa::where('nama', 'like', "%$search%")
                ->orWhere('nis', 'like', "%$search%")
                ->orWhere('rayon', 'like', "%$search%")
                ->orWhere('rombel', 'like', "%$search%")
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at
                ->paginate(5); // Menggunakan paginate untuk membatasi 5 data per halaman
        } else {
            // Ambil semua data siswa jika tidak ada pencarian, diurutkan dari terbaru
            $siswa = dataSiswa::orderBy('created_at', 'desc')->paginate(5); // Menggunakan paginate untuk membatasi 5 data per halaman
        }

        // Membangun chart
        $studentsChart = $studentsChart->build(); // Memanggil method build() untuk mendapatkan chart yang sudah terisi data

        return view('admin.index', ['siswa' => $siswa, 'studentsChart' => $studentsChart]); // Menampilkan halaman admin dengan chart
    }

    // Landing page untuk User
    public function userLandingPage()
    {
        return view('user.index'); // Menampilkan halaman user
    }
}

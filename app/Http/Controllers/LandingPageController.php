<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSiswa;

class LandingPageController extends Controller
{
    // Landing page utama (login)


    // Landing page untuk Admin
    public function adminLandingPage(Request $request)
    {
        $search = $request->input('search');

        // Filter data siswa jika ada input pencarian
        if ($search) {
            $siswa = dataSiswa::where('nama', 'like', "%$search%")
                ->orWhere('nis', 'like', "%$search%")
                ->orWhere('rayon', 'like', "%$search%")
                ->orWhere('rombel', 'like', "%$search%")
                ->get();
        } else {
            // Ambil semua data siswa jika tidak ada pencarian, diurutkan dari terbaru
            $siswa = dataSiswa::orderBy('created_at', 'desc')->get();
        }

        return view('admin.index', compact('siswa')); // Menampilkan halaman admin
    }

    // Landing page untuk User
    public function userLandingPage()
    {
        return view('user.index'); // Menampilkan halaman user
    }
}

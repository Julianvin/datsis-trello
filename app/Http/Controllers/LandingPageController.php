<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSiswa;

class LandingPageController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada input pencarian, filter data siswa
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

        return view('pages.index', compact('siswa'));
    }
}

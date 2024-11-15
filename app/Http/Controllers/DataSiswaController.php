<?php

namespace App\Http\Controllers;

use App\Models\dataSiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportPDF($id)
    {
        $siswa = dataSiswa::findOrFail($id); // Ambil data siswa berdasarkan ID
        $pdf = Pdf::loadView('admin.siswa.export-pdf', compact('siswa')); // Load tampilan 'export-pdf' dengan data siswa
        return $pdf->download("data-siswa-{$siswa->name}.pdf"); // Unduh file PDF dengan nama yang menyertakan ID siswa
    }

    public function index(Request $request)
    {
        $siswa = dataSiswa::where('nama', 'LIKE', '%' . $request->search_name . '%')->orderBy('nama', 'asc')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'nis' => 'required|numeric|digits:8',
                'rayon' => 'required|string|max:255',
                'rombel' => 'required|string|max:255',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi gambar
            ],
            [
                'nama.required' => 'Nama siswa wajib diisi.',
                'nama.string' => 'Nama siswa harus berupa teks.',
                'nama.max' => 'Nama siswa maksimal 255 karakter.',
                'nis.required' => 'NIS siswa wajib diisi.',
                'nis.numeric' => 'NIS siswa harus berupa angka.',
                'nis.digits' => 'NIS siswa harus 8 digit.',
                'rayon.required' => 'Rayon siswa wajib diisi.',
                'rayon.string' => 'Rayon siswa harus berupa teks.',
                'rayon.max' => 'Rayon siswa maksimal 255 karakter.',
                'rombel.required' => 'Rombel siswa wajib diisi.',
                'rombel.string' => 'Rombel siswa harus berupa teks.',
                'rombel.max' => 'Rombel siswa maksimal 255 karakter.',
                'gambar.required' => 'Gambar siswa wajib diisi.',
                'gambar.image' => 'Gambar siswa harus berupa gambar.',
            ]
        );

        // Mengambil file gambar
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/siswa'), $filename);

        // Menyimpan data siswa ke database
        dataSiswa::create([
            'nama' => $request->input('nama'),
            'nis' => $request->input('nis'),
            'rayon' => $request->input('rayon'),
            'rombel' => $request->input('rombel'),
            'gambar' => $filename,
        ]);

        return redirect()->route('siswa.data')->with('success', 'Data siswa berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(dataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // buat ngambil data siswa berdasarkan id
        $siswa = dataSiswa::findOrFail($id);
        // Kembalikan view ke halaman edit dengan data siswa yaitu id nya
        // compact berguna untuk mengirim variabel yang ada ke dalam view yang sudh di tentukan
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|numeric',
            'rayon' => 'required|string|max:255',
            'rombel' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        // Cari data siswa berdasarkan ID
        $siswa = dataSiswa::findOrFail($id);

        // Simpan data yang diperbarui
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->rayon = $request->rayon;
        $siswa->rombel = $request->rombel;

        // Periksa apakah ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($siswa->gambar && file_exists(public_path('assets/images/siswa/' . $siswa->gambar))) {
                unlink(public_path('assets/images/siswa/' . $siswa->gambar));
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/siswa'), $filename);
            // Simpan nama file baru ke dalam database
            $siswa->gambar = $filename;
        }

        // Simpan data yang diperbarui
        $siswa->save();

        // Redirect dengan pesan sukses
        return redirect()->route('siswa.data')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data siswa berdasarkan ID
        $siswa = dataSiswa::where('id', $id)->first();

        if ($siswa && file_exists(public_path('assets/images/siswa/' . $siswa->gambar))) {
            unlink(public_path('assets/images/siswa/' . $siswa->gambar));/* hapus gambar */
        }

        // Hapus data siswa dari database
        if ($siswa->delete()) {
            return redirect()->route('siswa.data')->with('success', "Data user $siswa->name berhasil dihapus!");
        } else {
            return redirect()->route('siswa.data')->with('error', "Data user $siswa->name gagal dihapus!");
        }
    }
}

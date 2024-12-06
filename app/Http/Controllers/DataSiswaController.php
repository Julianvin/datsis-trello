<?php

namespace App\Http\Controllers;

use App\Models\dataSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataSiswaExport;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportExcelDataSiswa()
    {
        return Excel::download(new DataSiswaExport, 'Rekap-data-siswa' . date('d-m-Y_H-i-s') . '.xlsx');
    }

    public function exportPDF($id)
    {
        $siswa = dataSiswa::findOrFail($id); // Ambil data siswa berdasarkan ID
        $pdf = Pdf::loadView('admin.siswa.export-pdf', compact('siswa')); // Load tampilan 'export-pdf' dengan data siswa
        return $pdf->download("data-siswa-{$siswa->id}-{$siswa->name}.pdf"); // Unduh file PDF dengan nama yang menyertakan ID siswa
        return $pdf->download("data-siswa-{$siswa->name}.pdf"); // Unduh file PDF dengan nama yang menyertakan ID siswa
    }

    public function index(Request $request)
    {
        // Ambil data siswa berdasarkan pencarian
        $siswa = dataSiswa::with('user')
            ->where('nama', 'LIKE', '%' . $request->search_name . '%')
            ->orderBy('nama', 'asc')
            ->get();


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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|numeric|digits:8|unique:data_siswa,nis',
            'rayon' => 'required|string|max:255',
            'rombel' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required_with:password|same:password',
        ], [
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password.',
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Panjang nama maksimal 255 karakter.',
            'nis.required' => 'NIS harus diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.digits' => 'Panjang NIS harus 8 digit.',
            'nis.unique' => 'NIS sudah digunakan.',
            'rayon.required' => 'Rayon harus diisi.',
            'rayon.string' => 'Rayon harus berupa teks.',
            'rayon.max' => 'Panjang rayon maksimal 255 karakter.',
            'rombel.required' => 'Rombel harus diisi.',
            'rombel.string' => 'Rombel harus berupa teks.',
            'rombel.max' => 'Panjang rombel maksimal 255 karakter.',
            'gambar.required' => 'Gambar harus diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'File harus berekstensi .jpeg, .png, atau .jpg .',
            'gambar.max' => 'Ukuran file maksimal 10MB.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Panjang password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password harus sama dengan password.',
        ]);

        // Mengambil file gambar
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/assets/images/', $filename);

        // Menyimpan data siswa ke database
        $siswa = dataSiswa::create([
            'nama' => $request->input('nama'),
            'nis' => $request->input('nis'),
            'rayon' => $request->input('rayon'),
            'rombel' => $request->input('rombel'),
            'gambar' => $filename,
        ]);

        // Membuat akun pengguna
        User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'data_siswa_id' => $siswa->id,
        ]);

        return redirect()->route('siswa.data')->with('success', 'Data siswa dan akun berhasil dibuat.');
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

        // Perbarui data siswa tanpa gambar
        $siswa->update($request->only(['nama', 'nis', 'rayon', 'rombel']));

        // Periksa apakah ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($siswa->gambar) {
                Storage::delete('public/assets/images/' . $siswa->gambar);
            }

            // Simpan gambar baru
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('public/assets/images/', $filename);

            // Simpan nama file gambar baru
            $siswa->update(['gambar' => $filename]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('siswa.data')->with('success', 'Data siswa berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $siswa = dataSiswa::findOrFail($id);

        // Hapus gambar jika ada
        if ($siswa->gambar) {
            Storage::delete('public/assets/images/' . $siswa->gambar);
        }

        // Hapus siswa dan relasinya
        $siswa->delete();

        return redirect()->route('siswa.data')->with('success', "Data siswa dan akun berhasil dihapus.");
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $users = User::where('name', 'LIKE', '%' . $request->search_name . '%')->orderBy('name', 'ASC')->get();
        return view('akuns.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('akuns.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->password);
        //validate adalah function untuk melakukan validasi ketika data yang diterima sesuai apa ngga
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required'
        ]);

        // dd($request->all());
        //create digunakan untuk menyimpan data baru ke dalam tabel users di database.
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // Untuk Encripsi pasword dari 345543 ke @HSGYT@%^LHHGSDGOSIJ
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('siswa.data.akun')->with('success', "Data user $request->name berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // buat ngambil data user berdasarkan id
        $users = User::find($id);
        // Kembalikan view ke halaman edit dengan data user yaitu id nya
        // compact berguna untuk mengirim variabel yang ada ke dalam view yang sudh di tentukan
        return view('akuns.edit', compact('users'));
    }

        //request untuk menerima data dari inputan form
        public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable', // Password bersifat opsional karna nullable

        ]);

        // Mencari user berdasarkan ID jika tidak di temukan berarti fail atau 404
        $users = User::findOrFail($id);

        // Update data user berdasarkan inputan form
        // name, email dan role di update berdasarkan inputan form
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;

        // Jika password diisi, maka lakukan enkripsi dan update bersifat opsional
        if ($request->filled('password')) {
            $users->password = bcrypt($request->password);
        }

        // function untuk Simpan perubahan ke databasenya
        $users->save();

        // akan mengarahkan ke halaman data user bersama session succes dengan pesan berhasil jika update succes
        return redirect()->route('siswa.data.akun')->with('success', 'Berhasil mengupdate akun!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Cari user berdasarkan ID
    $users = User::where('id', $id)->first();

    // Periksa apakah user ditemukan
    if ($users) {
        if ($users->delete()) {
            return redirect()->route('siswa.data.akun')->with('success', "Data user $users->name berhasil dihapus!");
        } else {
            return redirect()->route('siswa.data.akun')->with('error', "Data user $users->name gagal dihapus!");
        }
    } else {
        return redirect()->route('siswa.data.akun')->with('error', "Data user tidak ditemukan!");
    }
}

}

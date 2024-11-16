<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $users = User::where('name', 'LIKE', '%' . $request->search_name . '%')->orderBy('name', 'ASC')->get();
        return view('admin.akuns.index', compact('users'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Email atau nama tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        // Cek apakah username yang diinput adalah email atau nama
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Gunakan auth attempt dengan dynamic fieldType
        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
            // Mendapatkan pengguna yang login
            $user = Auth::user();

            // Mengarahkan pengguna berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('landing_page_admin')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('landing_page_siswa')->with('success', 'Selamat datang, Siswa!');
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with(['failed' => 'Nama/Email, dan password tidak sesuai']);
        }
    }


    public function showRegister()
    {
        return view('auth.register');
    }


    public function makeAcc(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed', // Menggunakan 'confirmed' untuk mencocokkan dengan 'password_confirmation'
        ]);

        // Membuat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        // Redirect setelah sukses register
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    /* Logout */
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout!');
    }
    /* error */
    public function error(Request $request)
    {
        return view('error')->with([
            'message' => session('message'),
            'requested_url' => $request->fullUrl(),
            'user' => auth()->user()
        ]);                          
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.akuns.create');
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
            'password' => 'required|required|min:8'
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
        return view('admin.akuns.edit', compact('users'));
    }

    //request untuk menerima data dari inputan form
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:8', // Password bersifat opsional karna nullable

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

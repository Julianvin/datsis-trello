<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\dataSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportExcelUsers()
    {
        return Excel::download(new UserExport, 'rekap-akun-' . date('d-m-Y_H-i-s') . '.xlsx');
    }

    public function index(Request $request)
    {
        //
        $users = User::with('dataSiswa')->where('email', 'LIKE', '%' . $request->search_name . '%')->orderBy('email', 'ASC')->get();
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
            'password' => 'required',
        ], [
            'username.required' => 'Nama siswa tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        // Cari user berdasarkan name di data_siswa
        $user = User::whereHas('dataSiswa', function ($query) use ($request) {
            $query->where('nama', $request->username);
        })->first();

        // Jika user ditemukan, verifikasi password
        if ($user && Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            // Mendapatkan pengguna yang login
            $authenticatedUser = Auth::user();

            // Mengarahkan pengguna berdasarkan role
            if ($authenticatedUser->role === 'admin') {
                return redirect()->route('landing_page_admin')->with('success', 'Selamat datang, Admin!');
            } elseif ($authenticatedUser->role === 'siswa') {
                return redirect()->route('landing_page_siswa')->with('success', 'Selamat datang, Siswa!');
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with(['failed' => 'Nama siswa dan password tidak sesuai']);
        }
    }
    public function showRegister()
    {
        return view('auth.register');
    }


    public function makeAcc(Request $request)
    {
        // Validasi data
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
        ]);

        // Mengambil file gambar
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/assets/images/', $filename);

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
            'password' => Hash::make($request->input('password')),
            'data_siswa_id' => $siswa->id,
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
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:8', // Password bersifat opsional karna nullable

        ]);

        // Mencari user berdasarkan ID jika tidak di temukan berarti fail atau 404
        $users = User::findOrFail($id);

        // Update data user berdasarkan inputan form
        // name, email dan role di update berdasarkan inputan form
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

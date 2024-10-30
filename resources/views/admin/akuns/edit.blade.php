@extends('layouts.layout')

@section('content')

    <div class="content flex-grow p-4 md:p-8">
        <h1 class="text-2xl font-bold mb-6" data-aos="fade-left">Buat Data Siswa</h1>

        <form action="{{ route('siswa.ubah.akun.formulir', $users->id) }}" method="POST" enctype="multipart/form-data"
            class="form-buat bg-white p-6 rounded-lg shadow-md space-y-4" data-aos="fade-up">
            @csrf
            @method('PATCH')
            @if ($errors->any())
                <div class="alert bg-red-500 text-white p-4 rounded-md" data-aos="fade-right">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4" data-aos="fade-up" data-aos-delay="100">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                <input type="text" id="name" name="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan name siswa" value="{{ $users->name }}">
            </div>

            <div class="flex flex-wrap" data-aos="fade-up">
                <div class="w-full md:w-1/2 mb-3 px-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                    <input type="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                        id="email" name="email" placeholder="Masukan Email" value="{{ $users->email }}">
                </div>
                <div class="w-full md:w-1/2 mb-3 px-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
                    <input type="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                        id="password" name="password" placeholder="••••••••" value="">
                    <span class="toggle-password" onclick="togglePassword()">
                        <i id="toggleIcon" class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="mb-3" data-aos="fade-up">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role:</label>
                <select
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    id="role" name="role">
                    <option selected disabled hidden>Pilih Role</option>
                    <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ $users->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>


            <div class="flex flex-col md:flex-row items-center justify-between">
                <button type="submit"
                    class="btn-buat bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2 md:mb-0 md:mr-2">
                    Simpan
                </button>
                <a href="{{ route('siswa.data.akun') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/akun/edit.js') }}"></script>
@endsection

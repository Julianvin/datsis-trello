@extends('layouts.layout')
@section('content')

    <div class="content flex-grow p-4 md:p-8">
        <h1 class="text-xl md:text-2xl font-bold mb-4">Mengubah Data Siswa</h1>
        <form action="{{ Route('siswa.ubah.formulir', $siswa->id) }}" method="POST" enctype="multipart/form-data"
            class="form-ubah bg-white p-4 md:p-6 rounded-lg shadow-md">
            @csrf
            @method('PATCH')
            @if ($errors->any())
                <div class="alert bg-red-500 text-white p-2 rounded mb-4" data-aos="fade-right">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4" data-aos="fade-up" data-aos-delay="100">
                <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                <input type="text" id="nama" name="nama" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan nama siswa" value="{{ $siswa->nama }}">
            </div>
            <div class="mb-4" data-aos="fade-up" data-aos-delay="150">
                <label for="nis" class="block text-gray-700 font-bold mb-2">NIS</label>
                <input type="number" id="nis" name="nis" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan NIS" value="{{ $siswa->nis }}">
            </div>
            <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                <label for="rayon" class="block text-gray-700 font-bold mb-2">Rayon</label>
                <input type="text" id="rayon" name="rayon" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan rayon" value="{{ $siswa->rayon }}">
            </div>
            <div class="mb-4" data-aos="fade-up" data-aos-delay="250">
                <label for="rombel" class="block text-gray-700 font-bold mb-2">Rombel</label>
                <input type="text" id="rombel" name="rombel" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan rombel" value="{{ $siswa->rombel }}">
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md mb-4" data-aos="fade-up" data-aos-delay="120">
                <h2 class="text-lg md:text-xl font-bold mb-4 text-center">Unggah Gambar</h2>
                <div id="drop-area"
                    class="flex flex-col items-center justify-center w-full h-48 md:h-64 border-2 border-dashed border-gray-300 rounded-lg bg-gray-100 mb-4">
                    <img id="preview-image" class="w-24 h-24 mt-4 hidden" alt="Preview Gambar">
                    <div id="drop-text" class="flex flex-col items-center justify-center h-full text-center">
                        <p class="mb-2">Seret dan lepas gambar di sini atau</p>
                        <button type="button" id="upload-button"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            Pilih Gambar
                        </button>
                    </div>
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden"
                        onchange="handleFiles(this.files)">
                    <p id="file-upload-message" class="mt-2 text-gray-600"></p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-2">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline btn-ubah w-full md:w-auto">
                    Simpan
                </button>
                <a href="{{ route('siswa.data') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline btn-batal w-full md:w-auto text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script src="{{ asset('assets/js/siswa/edit.js') }}" defer></script>
@endsection

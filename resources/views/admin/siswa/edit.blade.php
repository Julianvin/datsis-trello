@extends('layouts.layout')
@section('content')


<div class="content flex-grow p-8">
    <h1 class="text-2xl font-bold mb-4">Mengubah Data Siswa</h1>
    <form action="{{ Route('siswa.ubah.formulir', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="form-ubah bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PATCH')
        @if($errors->any())
        <div class="alert bg-red-500 text-white" data-aos="fade-right">
            <ul>
                @foreach($errors->all() as $error)
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
        <div class="w-1/2 bg-white p-6 rounded-lg shadow-md my-4" data-aos="fade-up" data-aos-delay="120">
            <h2 class="text-xl font-bold mb-4 text-center">Unggah Gambar</h2>
            <div id="drop-area" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-lg bg-gray-100 mb-4">
                @if($siswa->gambar)
                <img id="preview-image" src="{{ asset('assets/images/siswa/' . $siswa->gambar) }}" class="w-48 h-48 mt-4" alt="Preview Gambar">
                @else
                <img id="preview-image" class="w-full h-auto mt-4 hidden" alt="Preview Gambar">
                @endif
                <label for="gambar" class="cursor-pointer text-gray-500">
                    <div class="flex flex-col items-center justify-center h-full">
                        <p class="mb-2">Seret dan lepas gambar di sini atau</p>
                        <button type="button" id="upload-button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Pilih Gambar</button>
                    </div>
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden" onchange="handleFiles(this.files)">
                </label>
                <p id="file-upload-message" class="mt-2 text-gray-600"></p>
                <img id="preview-image" class="w-full h-auto mt-4 hidden" alt="Preview Gambar">
            </div>
        </div>



        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline btn-ubah">
                Simpan
            </button>
            <a href="{{ route('siswa.data') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline btn-batal">
                Batal
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/siswa/edit.js') }}" defer></script>
@endsection

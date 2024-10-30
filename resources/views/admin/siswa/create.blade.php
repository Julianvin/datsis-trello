@extends('layouts.layout')

@section('content')
<style>
    #preview-image {
        max-height: 6rem; /* Sesuaikan tinggi div drag-and-drop */
        object-fit: cover; /* Memastikan gambar tetap proporsional */
        width: auto; /* Sesuaikan lebar */
    }
</style>

<div class="content flex-grow p-4 md:p-8">
    <h1 class="text-2xl font-bold mb-6" data-aos="fade-left">Buat Data Siswa</h1>

    <form action="{{ route('siswa.tambah.formulir') }}" method="POST" enctype="multipart/form-data"
        class="form-buat bg-white p-6 rounded-lg shadow-md space-y-4" data-aos="fade-up">
        @csrf

        @if($errors->any())
        <div class="alert bg-red-500 text-white p-4 rounded-md" data-aos="fade-right">
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
                placeholder="Masukkan nama siswa" value="{{ old('nama') }}">
        </div>

        <div class="mb-4" data-aos="fade-up" data-aos-delay="150">
            <label for="nis" class="block text-gray-700 font-bold mb-2">NIS</label>
            <input type="number" id="nis" name="nis" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Masukkan NIS" value="{{ old('nis') }}">
        </div>

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
            <label for="rayon" class="block text-gray-700 font-bold mb-2">Rayon</label>
            <input type="text" id="rayon" name="rayon" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Masukkan rayon" value="{{ old('rayon') }}">
        </div>

        <div class="mb-4" data-aos="fade-up" data-aos-delay="250">
            <label for="rombel" class="block text-gray-700 font-bold mb-2">Rombel</label>
            <input type="text" id="rombel" name="rombel" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Masukkan rombel" value="{{ old('rombel') }}">
        </div>

        <div class="bg-white p-6 rounded-lg my-4" data-aos="fade-up" data-aos-delay="120">
            <h2 class="text-xl font-bold mb-4 text-center">Unggah Gambar Siswa</h2>
            <div class="flex flex-col items-center justify-center w-full max-w-md mx-auto h-52 border-2 border-dashed border-gray-300 rounded-lg bg-gray-100 mb-4" id="drop-area">
                <label for="gambar" class="cursor-pointer text-gray-500">
                    <div id="drop-area" class="flex flex-col items-center justify-center h-full">
                        <img id="preview-image" class="w-full h-auto mt-4 hidden" alt="Preview Gambar">
                        <p class="mb-2">Seret dan lepas gambar di sini atau</p>
                        <button type="button" id="upload-button" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Pilih Gambar</button>
                    </div>
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden" onchange="handleFiles(this.files)" value="{{ old('gambar') }}">
                </label>
                <p id="file-upload-message" class="mt-2 text-gray-600"></p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between">
            <button type="submit"
                class="btn-buat bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2 md:mb-0 md:mr-2">
                Simpan
            </button>
            <a href="{{ route('siswa.data') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Batal
            </a>
        </div>
    </form>
</div>

<script src="{{ asset('assets/js/siswa/create.js') }}" defer></script>
@endsection

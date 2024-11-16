@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6" data-aos="fade-left">Buat Data Siswa</h1>

        <form action="{{ route('siswa.tambah.formulir') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6 space-y-6" data-aos="fade-up">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <div data-aos="fade-up" data-aos-delay="100">
                    <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama siswa" value="{{ old('nama') }}">
                    @error('nama')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="nis" class="block text-gray-700 font-bold mb-2">NIS</label>
                    <input type="number" id="nis" name="nis" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan NIS" value="{{ old('nis') }}">
                    @error('nis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <label for="rayon" class="block text-gray-700 font-bold mb-2">Rayon</label>
                    <input type="text" id="rayon" name="rayon" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan rayon" value="{{ old('rayon') }}">
                    @error('rayon')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div data-aos="fade-up" data-aos-delay="250">
                    <label for="rombel" class="block text-gray-700 font-bold mb-2">Rombel</label>
                    <input type="text" id="rombel" name="rombel" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan rombel" value="{{ old('rombel') }}">
                    @error('rombel')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-8" data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-xl font-bold mb-4">Unggah Gambar Siswa</h2>
                <div class="flex flex-col md:flex-row gap-6">
                    <div id="drop-area"
                        class="w-full md:w-1/3 p-4 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center hover:bg-gray-50 transition duration-300 ease-in-out">
                        <p id="file-upload-message" class="text-gray-500 text-center mb-2">Seret dan jatuhkan gambar di sini
                        </p>
                        <p id="drag-and-drop-text" class="text-sm text-gray-400 mb-2">Atau</p>
                        <label id="upload-button" for="gambar"
                            class="cursor-pointer text-blue-500 hover:text-blue-700 font-medium">
                            Pilih Gambar
                        </label>
                        <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden"
                            onchange="handleFiles(this.files)">
                            @error('gambar')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        <img id="preview-image" src="{{ old('gambar') ? asset('storage/' . old('gambar')) : '' }}"
                            class="hidden w-full h-auto mt-4 rounded-lg border-2 border-gray-300 object-cover max-h-48"
                            alt="Preview Gambar">
                    </div>
                    <div class="w-full md:w-2/3">
                        <p class="text-sm text-gray-500">Gambar harus berupa file dengan ekstensi .jpg, .jpeg, atau .png dan
                            ukuran maksimal 10MB.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8" data-aos="fade-up" data-aos-delay="350">
                <h2 class="text-xl font-bold mb-4">Buat Akun</h2>
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                value="{{ old('password') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', 'toggleIcon')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="toggleIcon" class="fas fa-eye-slash text-gray-600"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePasswordConfirm('password_confirmation', 'toggleIconC')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="toggleIconC" class="fas fa-eye-slash text-gray-600"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center mt-8 space-y-4 sm:space-y-0 sm:space-x-4">
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                    Simpan
                </button>
                <a href="{{ route('siswa.data') }}"
                    class="w-full sm:w-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script src="{{ asset('assets/js/siswa/create.js') }}" defer></script>
@endsection

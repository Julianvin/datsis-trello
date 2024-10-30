@extends('layouts.layout')

@section('content')
    <style>
        .object-cover {
            object-fit: cover;
        }
    </style>

    <div class="content flex-grow p-4 md:p-8">
        <h1 class="text-2xl font-bold mb-4" data-aos="fade-down">Daftar Siswa</h1>
        {{-- session succes --}}
        @if (Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ Session::get('success') }}", // Mengambil pesan dari session
                        icon: "success",
                        position: "center", // Menetapkan posisi SweetAlert di tengah
                        showConfirmButton: false, // Tidak menampilkan tombol OK
                        timer: 2500, // Durasi dalam milidetik (1,5 detik)
                        timerProgressBar: true, // Menampilkan progress bar untuk timer
                    });
                });
            </script>
        @endif

        @if (Session::has('failed'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Oops...",
                        text: "{{ Session::get('failed') }}", // Mengambil pesan dari session
                        icon: "error",
                        position: "center", // Menetapkan posisi SweetAlert di tengah
                        showConfirmButton: true, // Tidak menampilkan tombol OK
                        timer: 2500, // Durasi dalam milidetik (1,5 detik)
                        timerProgressBar: true, // Menampilkan progress bar untuk timer
                    });
                });
            </script>
        @endif

        <!-- Form Pencarian -->
        <div class="flex justify-between items-center mb-6" data-aos="fade-down" data-aos-delay="100">
            @if (Auth::user()->role == 'admin')
            <div class="flex">
                <a href="{{ route('siswa.data') }}"
                    class="inline-block bg-gray-600 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-700 transition duration-300 ease-in-out mr-4">
                    <i class="fa-solid fa-arrow-left"></i> CRUD Data Siswa
                </a>
                <a href="{{ route('siswa.data.akun') }}"
                    class="inline-block bg-gray-600 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-700 transition duration-300 ease-in-out">
                    <i class="fa-solid fa-arrow-left"></i> CRUD Data Akun Siswa
                </a>
            </div>
            @endif
            <form action="{{ route('landing_page_admin') }}" method="GET" class="flex items-center w-full md:w-auto"
                data-aos="fade-left" data-aos-delay="200">
                <input type="text" name="search" placeholder="Cari nama, NIS, rayon, atau rombel..."
                    class="w-full md:w-24 md:flex-1 transition-all duration-300 ease-in-out p-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm"
                    value="{{ request('search') }}" onfocus="this.classList.add('md:w-96');"
                    onblur="if (this.value == '') { this.classList.remove('md:w-96'); }">
                <button type="submit"
                    class="bg-gray-600 hover:bg-gray-800 text-white py-3 px-5 rounded-r-lg transition duration-300 ease-in-out shadow-md">
                    Cari
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @forelse($siswa as $index => $item)
                <div class="bg-yellow-300 rounded-lg shadow-md p-4" data-aos="zoom-in-up"
                    data-aos-delay="{{ 100 + $index * 50 }}">
                    <div class="w-full h-96 md:h-64 bg-gray-200 overflow-hidden rounded-lg mb-4">
                        @if ($item->gambar && file_exists(public_path('assets/images/siswa/' . $item->gambar)))
                            <img src="{{ asset('assets/images/siswa/' . $item->gambar) }}" alt="Gambar {{ $item->nama }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('assets/images/default.png') }}" alt="Default Image"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <h2 class="text-lg font-bold text-center mb-2">{{ $item->nama }}</h2>
                    <p class="text-center">{{ $item->nis }}- {{ $item->rombel }}</p>
                    <p class="text-center mt-2"><strong>Rayon:</strong> {{ $item->rayon }}</p>
                </div>
            @empty
                <div class="bg-yellow-300 rounded-lg shadow-md p-4" data-aos="zoom-in-up" data-aos-delay="100">
                    <p class="text-center font-bold text-xl">Belum ada data yang diinput, tolong input data terlebih dahulu!
                    </p>
                </div>
            @endforelse
        </div>

    </div>
@endsection

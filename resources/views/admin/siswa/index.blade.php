@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/siswa/index.css') }}">

@if(Session::has('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "Berhasil!",
            text: "{{ Session::get('success') }}", // Mengambil pesan dari session
            icon: "success",
            position: "center", // Menetapkan posisi SweetAlert di tengah
            showConfirmButton: false, // Tidak menampilkan tombol OK
            timer: 2000, // Durasi dalam milidetik (1,5 detik)
            timerProgressBar: true, // Menampilkan progress bar untuk timer
        });
    });
</script>
@endif


<div class="container mx-auto mt-5 px-4 md:px-8">
    <div class="header shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-500 text-white text-center py-4">
            <h5 class="text-lg font-semibold">Daftar Siswa</h5>
        </div>

        <div class="p-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 b-4">
                <a href="{{ route('landing_page_admin') }}"
                    class="mt-2 text-lg font-semibold text-gray-500 hover:text-gray-700 hover:underline">
                    <i class="fa-solid fa-arrow-left"></i> Halaman Daftar siswa
                </a>
                <form class="flex justify-end space-x-2 w-full md:w-1/3" action="" method="GET">
                    <input type="text" name="search_name"
                        class="w-full border border-gray-300 p-2 rounded-lg transition-all duration-300
                        focus:w-full focus:flex-1 focus:pl-8 focus:pr-8 focus:text-lg"
                        placeholder="Cari Data Siswa " value="{{ request('search_name') }}"
                        style="width: {{ request('search_name') ? '100%' : '9rem' }};"
                        onfocus="this.style.width='100%';"
                        onblur="this.style.width='9rem';">
                    <button class="search-btn text-white px-4 py-2 rounded-lg hover:bg-gray-600"
                        type="submit">Cari</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr class="text-gray-600">
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">NIS</th>
                            <th class="px-4 py-2 text-left">Rayon</th>
                            <th class="px-4 py-2 text-left">Rombel</th>
                            <th class="px-4 py-2 text-left">Foto</th>
                            <th class="px-4 py-2 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @forelse($siswa as $index => $item)
                        <tr class="border-b hover:bg-gray-50" data-aos="fade-left" data-aos-delay="{{ $index * 50 }}">
                            <td class="px-4 py-2">{{ $no++ }}</td>
                            <td class="px-4 py-2">{{ $item->nama }}</td>
                            <td class="px-4 py-2">{{ $item->nis }}</td>
                            <td class="px-4 py-2">{{ $item->rayon }}</td>
                            <td class="px-4 py-2">{{ $item->rombel }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('assets/images/siswa/' . $item->gambar) }}"
                                    alt="Foto {{ $item->nama }}" class="h-12 w-12 object-cover">
                            </td>

                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('siswa.edit', $item->id) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Data Siswa tidak tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-4 text-right">
            <a href="{{ route('siswa.tambah') }}"
                class="add-btn bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Tambah Siswa</a>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/siswa/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@extends('layouts.layout')

@section('content')
    <div class="container mx-auto mt-5">
        @if (Session::has('success'))
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
                <div class="bg-gray-600 text-white text-center py-3 rounded-t-lg">
                    <h5 class="text-lg font-bold">Daftar Akun</h5>
                </div>

                <div class="p-4">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
                        <div></div> <!-- Ruang kosong untuk membantu alignment di sisi kiri -->
                        <form class="flex justify-end space-x-2 w-full md:w-1/3" action="" method="GET">
                            <input type="text" name="search_name"
                                class="w-full border border-gray-300 p-2 rounded-lg transition-all duration-300
                                focus:w-full focus:flex-1 focus:pl-8 focus:pr-8 focus:text-lg"
                                placeholder="Cari Data Siswa" value="{{ request('search_name') }}"
                                style="width: {{ request('search_name') ? '100%' : '9rem' }};"
                                onfocus="this.style.width='100%';" onblur="this.style.width='9rem';">
                            <button class="search-btn text-white bg-gray-500 px-4 py-2 rounded-lg hover:bg-gray-600"
                                type="submit">Cari</button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead class="bg-gray-100 border-b">
                                <tr class="text-gray-600">
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Nama</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Role</th>
                                    <th class="px-4 py-2 text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @forelse($users as $index => $item)
                                    <tr class="border-b hover:bg-gray-50" data-aos="fade-left"
                                        data-aos-delay="{{ $index * 50 }}">
                                        <td class="px-4 py-2">{{ $no++ }}</td>
                                        <td class="px-4 py-2">{{ $item->name }}</td>
                                        <td class="px-4 py-2">{{ $item->email }}</td>
                                        <td class="px-4 py-2">{{ $item->role }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('siswa.edit.akun', $item->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded-md">Ubah</a>
                                                <form action="{{ route('siswa.destroy.akun', $item->id) }}" method="POST"
                                                    class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-md btn-delete">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 py-4">Data tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 text-right">
                        <a href="{{ route('siswa.tambah.akun') }}"
                            class="add-btn bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="bi bi-plus-circle"></i> Tambah akun
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('assets/js/akun/index.js') }}" defer></script>
    @endsection

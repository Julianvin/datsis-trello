@extends('layouts.layout')

@section('content')

<div class="container mx-auto mt-5">
    @if(Session::has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ Session::get('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    <div class="bg-white shadow-sm rounded-lg max-w-7xl mx-auto border-none">
        <div class="flex justify-end gap-3 mb-2 px-4 py-2">
            <form class="flex" role="search" action="{{ route('siswa.data.akun') }}" method="GET">
                <input type="text"
                    class="form-input border rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400"
                    placeholder="Search Data" aria-label="Search" name="search_name">
                <button
                    class="bg-white border border-gray-500 text-gray-500 rounded-r-md px-3 py-2 hover:bg-gray-500 hover:text-white transition-colors"
                    type="submit">Search</button>
            </form>
        </div>

        <div class="bg-gray-600 text-white text-center py-3 rounded-t-lg">
            <h5 class="text-lg font-bold">Daftar Akun</h5>
        </div>

        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 border-b-2 border-gray-200">
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
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $no++ }}</td>
                            <td class="px-4 py-2">{{ $item->name }}</td>
                            <td class="px-4 py-2">{{ $item->email }}</td>
                            <td class="px-4 py-2">{{ $item->role }}</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('siswa.edit.akun', $item->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded-md">Ubah</a>
                                    <form action="{{ route('siswa.destroy.akun', $item->id) }}" method="POST"
                                        class="d-inline form-delete">
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
                            <td colspan="6" class="text-center text-gray-500 py-4">Data tidak tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('siswa.tambah.akun') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                    <i class="bi bi-plus-circle"></i> Tambah akun
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/akun/index.js') }}" defer></script>
@endsection

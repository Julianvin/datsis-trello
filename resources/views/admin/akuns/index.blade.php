@extends('layouts.layout')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gray-700 px-4 py-4">
                <h2 class="text-xl font-bold text-white">Daftar Akun Siswa</h2>
            </div>

            <div class="p-4 space-y-4">

                <!-- Navigation and Search -->
                <div class="p-4 space-y-4">

                    <!-- Export Excel Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('siswa.export.excel.dataAkun') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
                            <i class="fa-solid fa-file-excel mr-2"></i>
                            Export Excel
                        </a>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        <span></span>
                        <form action="" method="GET" class="w-full sm:w-auto">
                            <div class="relative">
                                <input type="text" name="search_name"
                                    class="w-full sm:w-64 pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Cari Data Siswa" value="{{ request('search_name') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden space-y-4">
                    @forelse($users as $item)
                        <div class="bg-white shadow rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->email }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ $item->role }}
                                </div>
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                Tanggal Pembuatan: <br>
                                <span class="block text-gray-900 font-medium">
                                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }}
                                </span>
                            </div>
                            <div class="mt-4 flex justify-between items-center space-x-2">
                                <a href="{{ route('siswa.edit.akun', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-sm hover:bg-yellow-200">
                                    <i class="fa-solid fa-pen mr-1"></i> Ubah
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Data tidak tersedia</p>
                    @endforelse
                </div>


                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal pembuatan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->dataSiswa->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->role }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('siswa.edit.akun', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-sm hover:bg-yellow-200">
                                                <i class="fa-solid fa-pen mr-1"></i> Ubah
                                            </a>
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

            </div>
            {{-- </div>
        <div class="fixed bottom-6 right-6 md:static md:flex md:justify-end md:mt-4">
            <a href="{{ route('siswa.tambah.akun') }}"
                class="inline-flex items-center justify-center w-14 h-14 md:w-auto md:h-auto md:px-6 md:py-3 bg-blue-600 text-white rounded-full md:rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
                <i class="fa-solid fa-plus md:mr-2"></i>
                <span class="hidden md:inline">Tambah Siswa</span>
            </a>
        </div> --}}
        </div>

        <!-- SweetAlert for Success Message -->
        @if (Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ Session::get('success') }}",
                        icon: "success",
                        position: "center",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                });
            </script>
        @endif
    @endsection

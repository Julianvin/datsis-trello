@extends('layouts.layout')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gray-700 px-4 py-4">
                <h2 class="text-xl font-bold text-white">Daftar Siswa</h2>
            </div>

            <!-- Navigation and Search -->
            <div class="p-4 space-y-4">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('landing_page_admin') }}"
                        class="inline-flex items-center text-gray-600 hover:text-gray-900">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>

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

                <!-- Mobile Data Cards -->
                <div class="block md:hidden">
                    @forelse($siswa as $item)
                        <div class="bg-white rounded-lg shadow mb-4 p-4">
                            <div class="flex items-center space-x-4 mb-3">
                                <img src="{{ asset('/storage/assets/images/' . $item->gambar) }}"
                                    alt="Foto {{ $item->nama }}" class="h-12 w-12 rounded-full object-cover">
                                <div>
                                    <h3 class="font-semibold">{{ $item->nama }}</h3>
                                    <p class="text-sm text-gray-500">NIS: {{ $item->nis }}</p>
                                </div>
                            </div>

                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Rayon:</span> {{ $item->rayon }}</p>
                                <p><span class="font-medium">Rombel:</span> {{ $item->rombel }}</p>
                                <p><span class="font-medium">Email:</span> {{ $item->user->email }}</p>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <a href="{{ route('siswa.export-pdf', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-md text-sm"
                                    target="_blank">
                                    <i class="fa-solid fa-print mr-1"></i>
                                    PDF
                                </a>
                                <a href="{{ route('siswa.edit', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-sm">
                                    <i class="fa-solid fa-pen mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md text-sm">
                                        <i class="fa-solid fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            Data Siswa tidak tersedia
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIS</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rayon</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rombel</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($siswa as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->rayon }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->rombel }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('/storage/assets/images/' . $item->gambar) }}"
                                            alt="Foto {{ $item->nama }}" class="h-10 w-10 rounded-full object-cover">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center justify-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <div class="relative group">
                                                <a href="{{ route('siswa.export-pdf', $item->id) }}"
                                                    class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors duration-200"
                                                    target="_blank">
                                                    <i class="fa-solid fa-print mr-1"></i>
                                                    <span class="hidden sm:inline">PDF</span>
                                                </a>
                                                <div
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                    Export as PDF
                                                </div>
                                            </div>

                                            <div class="relative group">
                                                <a href="{{ route('siswa.edit', $item->id) }}"
                                                    class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition-colors duration-200">
                                                    <i class="fa-solid fa-pen mr-1"></i>
                                                    <span class="hidden sm:inline">Edit</span>
                                                </a>
                                                <div
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                    Edit student data
                                                </div>
                                            </div>

                                            <div class="relative group">
                                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors duration-200">
                                                        <i class="fa-solid fa-trash mr-1"></i>
                                                        <span class="hidden sm:inline">Delete</span>
                                                    </button>
                                                </form>
                                                <div
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap">
                                                    Delete student data
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        Data Siswa tidak tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Floating Action Button for Mobile -->
        <div class="fixed bottom-6 right-6 md:static md:flex md:justify-end md:mt-4">
            <a href="{{ route('siswa.tambah') }}"
                class="inline-flex items-center justify-center w-14 h-14 md:w-auto md:h-auto md:px-6 md:py-3 bg-blue-600 text-white rounded-full md:rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
                <i class="fa-solid fa-plus md:mr-2"></i>
                <span class="hidden md:inline">Tambah Siswa</span>
            </a>
        </div>
    </div>

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

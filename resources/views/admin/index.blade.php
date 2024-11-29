@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-50/50">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div class="flex items-center space-x-3" data-aos="fade-right">
                    <div class="p-2 bg-blue-600 rounded-lg">
                        <i class="fa-solid fa-gauge-high text-xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
                        <p class="text-gray-500">Selamat datang kembali, admin</p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0" data-aos="fade-left">
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Siswa -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-users text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm font-medium">Total Siswa</p>
                            <div class="flex items-center space-x-1">
                                <h3 class="text-2xl font-bold text-gray-800">
                                    {{ $siswa->where('user.role', 'siswa')->count() }}</h3>
                                <span
                                    class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">+12%</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('siswa.data') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat detail <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Siswa Aktif -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-green-50 text-green-600">
                            <i class="fa-solid fa-user-check text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm font-medium">Siswa Aktif</p>
                            <div class="flex items-center space-x-1">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $siswa->where('status', 'aktif')->count() }}
                                </h3>
                                <span
                                    class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">98%</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500">
                            <span class="font-medium text-green-600">{{ $siswa->where('status', 'aktif')->count() }}</span>
                            dari {{ $siswa->count() }} siswa
                        </p>
                    </div>
                </div>

                <!-- Rata-rata Nilai -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm font-medium">Rata-rata Nilai</p>
                            <div class="flex items-center space-x-1">
                                <h3 class="text-2xl font-bold text-gray-800">85.7</h3>
                                <span
                                    class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">+2.5%</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 85.7%"></div>
                        </div>
                    </div>
                </div>

                <!-- Kehadiran -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-center">
                        <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600">
                            <i class="fa-solid fa-calendar-check text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm font-medium">Kehadiran</p>
                            <div class="flex items-center space-x-1">
                                <h3 class="text-2xl font-bold text-gray-800">96.8%</h3>
                                <span
                                    class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">+0.8%</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Target: 95%</span>
                            <span class="text-green-600 font-medium">Tercapai</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Statistik Siswa Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100" data-aos="fade-up"
                    data-aos-delay="500">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Statistik Siswa</h2>

                    </div>
                    <div class="aspect-[16/9]">
                        {!! $studentsChart->container() !!}
                    </div>
                </div>

                <!-- Distribusi Jurusan -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100" data-aos="fade-up"
                    data-aos-delay="600">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Distribusi Jurusan</h2>
                        <button class="text-sm text-gray-500 hover:text-gray-700">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <!-- RPL -->
                        <div class="flex items-center">
                            <div class="w-2/5">
                                <span class="text-sm font-medium text-gray-600">RPL</span>
                            </div>
                            <div class="w-3/5 flex items-center">
                                <div class="w-full bg-gray-100 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">65%</span>
                            </div>
                        </div>
                        <!-- TKJ -->
                        <div class="flex items-center">
                            <div class="w-2/5">
                                <span class="text-sm font-medium text-gray-600">TKJ</span>
                            </div>
                            <div class="w-3/5 flex items-center">
                                <div class="w-full bg-gray-100 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 40%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">40%</span>
                            </div>
                        </div>
                        <!-- MMD -->
                        <div class="flex items-center">
                            <div class="w-2/5">
                                <span class="text-sm font-medium text-gray-600">MMD</span>
                            </div>
                            <div class="w-3/5 flex items-center">
                                <div class="w-full bg-gray-100 rounded-full h-2.5">
                                    <div class="bg-purple-600 h-2.5 rounded-full" style="width: 25%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">25%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse ($siswa as $s)
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <img src="{{ asset('storage/assets/images/' . $s->gambar) }}" alt="Foto {{ $s->nama }}" class="w-10 h-10 rounded-full object-cover">
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $s->nama }} ditambahkan</p>
                                <p class="text-sm text-gray-500">{{ $s->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada siswa yang ditemukan.</p>
                    @endforelse
                </div>

                <!-- Kontrol Pagination -->
                <div class="mt-4">
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Sweet Alert Notifications -->
    @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ Session::get('success') }}",
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    toast: true,
                    customClass: {
                        popup: 'animated fadeInRight'
                    }
                });
            });
        </script>
    @endif

    @if (Session::has('failed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Oops...",
                    text: "{{ Session::get('failed') }}",
                    icon: "error",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    toast: true,
                    customClass: {
                        popup: 'animated fadeInRight'
                    }
                });
            });
        </script>
    @endif

    <!-- Chart Scripts -->
    <script src="{{ $studentsChart->cdn() }}"></script>
    {!! $studentsChart->script() !!}

    <style>
        /* Custom Animations */
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        .fadeInRight {
            animation-name: fadeInRight;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #666;
        }
    </style>
@endsection

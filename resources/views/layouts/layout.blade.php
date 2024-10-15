<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row">
        <!-- Tombol Toggle untuk Sidebar (Mobile) -->
        <div class="md:hidden bg-gray-600 text-white p-4 flex justify-between items-center">
            <h1 class="font-bold text-xl">Data Siswa</h1>
            <button onclick="toggleMobileSidebar()" class="focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="mobileSidebar"
            class="fixed inset-0 bg-gray-600 text-white flex flex-col md:relative md:w-64 h-screen md:h-auto transform md:transform-none transition-transform duration-300 -translate-x-full md:translate-x-0 z-20">
            <!-- Judul Navbar -->
            <a href="{{ route('landing_page') }}"
                class="p-4 bg-gray-800 text-center font-bold text-xl block flex items-center">
                <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo Wikrama" class="w-10 h-10 mr-2">
                Data Siswa
            </a>
            <!-- Navbar Items -->
            <nav class="flex-grow p-4 space-y-1">
                <!-- Item dengan Dropdown -->
                <div
                    class="border-b border-gray-700 {{ Route::is('siswa.data') || Route::is('siswa.tambah') ? 'bg-gray-800' : '' }}">
                    <button onclick="toggleDropdown()"
                        class="flex items-center justify-start w-full px-3 py-2 text-base font-medium text-white hover:bg-gray-800">
                        <span class="mr-auto">
                            @if (Route::is('siswa.data'))
                            Data Siswa
                            @elseif (Route::is('siswa.data.akun'))
                            Kelola Akun
                            @else
                            Siswa
                            @endif
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="dropdown" class="hidden mt-2 bg-white rounded-md shadow-xl z-10">
                        <a href="{{ route('siswa.data') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-gray-700">
                            Data Siswa
                        </a>
                        <a href="{{ route('siswa.data.akun') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Kelola akun siswa
                        </a>
                    </div>
                </div>

                <!-- Item lain di navbar dengan garis bawah -->
                <div class="border-b border-gray-700">
                    <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:bg-gray-800">
                        Item 1
                    </a>
                </div>
            </nav>
        </div>

        <!-- Konten Utama -->
        <div class="flex-grow md:ml-12 p-4 md:p-6 min-h-screen">
            @yield('content')
            <!-- Tempat konten dinamis akan dimasukkan -->
        </div>
    </div>

    {{-- js data-aos --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true,
        });
    </script>

</body>

</html>

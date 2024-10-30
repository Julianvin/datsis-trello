<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Dashboard</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-roboto">


    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-800 text-white w-64 h-screen hidden md:block fixed overflow-y-auto">
            <div class="p-4 bg-gray-900 flex items-center justify-between">
                <a href="{{ route('landing_page_admin') }}" class="flex items-center">
                    <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo Wikrama" class="w-10 h-10 mr-2">
                    <span class="text-lg font-bold">Data Siswa</span>
                </a>
                <button class="md:hidden text-white" onclick="toggleSidebar()">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <nav class="p-4">
                <a href="{{ route('siswa.data') }}" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                    <i class="fa-solid fa-users mr-2"></i> Data Siswa
                </a>
                <a href="{{ route('siswa.data.akun') }}"
                    class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                    <i class="fa-solid fa-user-cog mr-2"></i> Kelola Akun
                </a>
                <div class="mt-2 border-t border-gray-700"></div>
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                    <i class="fa-solid fa-chart-bar mr-2"></i> Analisis
                </a>
                <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                    <i class="fa-solid fa-cogs mr-2"></i> Pengaturan
                </a>
                @if (Auth::check())
                    <a href="" onclick="confirmLogout(event)"
                        class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
                    </a>
                @endif
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-grow ml-0 md:ml-64 p-6 bg-gray-100 ">
            <div class="fixed top-0 left-0 w-full bg-gray-800 p-4 md:hidden flex items-center justify-between">
                <span class="text-white font-bold">Data Siswa</span>
                <button class="text-white" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <main class="">
                @yield('content')
                <!-- Tempat konten dinamis akan dimasukkan -->
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pages/layout.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true,
            disable: 'mobile',
            anchorPlacement: 'top-bottom',
            offset: -100,
        });
    </script>
</body>

</html>

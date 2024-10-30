<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Halaman Siswa</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-roboto">
    <nav class="bg-gray-800 text-white p-4 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{route('landing_page_siswa')}}" class="flex items-center">
                <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo Wikrama" class="w-8 h-8 mr-2">
                <span class="text-lg font-bold">Data Siswa</span>
            </a>

            <!-- Menu Navigasi -->
            <div class="flex items-center space-x-4">
                @if (Auth::check())
                    <a href="#"
                        class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-users mr-2"></i> Data Siswa
                    </a>
                    <a href="#" onclick="confirmLogout(event)"
                        class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
        <main >
            @yield('content')
        </main>


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/pages/layout.js') }}"></script>
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

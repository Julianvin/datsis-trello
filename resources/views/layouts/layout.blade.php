<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Dashboard</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-roboto">
    <div class="min-h-screen flex">
        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"
            onclick="closeSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-gray-800 text-white w-64 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-30">
            <div class="flex flex-col h-full">
                <div class="p-4 bg-gray-900 flex justify-between items-center">
                    <a href="{{ route('landing_page_admin') }}" class="flex items-center">
                        <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo Wikrama"
                            class="w-8 h-8 mr-2">
                        <span class="text-lg font-bold">Data Siswa</span>
                    </a>
                    <button id="closeSidebar" class="text-white md:hidden" onclick="closeSidebar()">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto py-4">
                    <a href="{{ route('siswa.data') }}"
                        class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <i class="fa-solid fa-users w-5 mr-3"></i>
                        <span>Data Siswa</span>
                    </a>
                    <a href="{{ route('siswa.data.akun') }}"
                        class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <i class="fa-solid fa-user-cog w-5 mr-3"></i>
                        <span>Kelola Akun</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <i class="fa-solid fa-chart-bar w-5 mr-3"></i>
                        <span>Analisis</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700">
                        <i class="fa-solid fa-cogs w-5 mr-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>

                @if (Auth::check())
                    <div class="p-4 border-t border-gray-700">
                        <a href="#" onclick="confirmLogout(event)"
                            class="flex items-center text-gray-300 hover:bg-gray-700 px-4 py-2 rounded-md">
                            <i class="fa-solid fa-arrow-right-from-bracket w-5 mr-3"></i>
                            <span>Keluar</span>
                        </a>
                    </div>
                @endif
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen md:pl-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-20 sticky top-0">
                <div class="flex items-center justify-between h-16 px-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle"
                            class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                            <i class="fa-solid fa-bars w-6 h-6"></i>
                        </button>
                        <h1 class="ml-2 text-xl font-semibold text-gray-900">Dashboard</h1>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-4 py-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pages/layout.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true,
            disable: 'mobile',
        });

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            sidebarToggle.addEventListener('click', openSidebar);

            // Make closeSidebar function available globally
            window.closeSidebar = closeSidebar;
        });

        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Dashboard</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Prevent scroll when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
        }

        /* Simple transitions */
        .sidebar {
            transition: transform 0.3s ease;
        }

        .overlay {
            transition: opacity 0.3s ease;
        }

        /* Active nav item */
        .nav-active {
            @apply bg-indigo-50 text-indigo-600;
        }

        .nav-active i {
            @apply text-indigo-600;
        }

        .sidebar.collapsed {
            width: 4rem;
            /* 64px */
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        /* Transisi untuk main content */
        .main-content {
            transition: padding-left 0.3s ease;
        }

        .main-content.sidebar-collapsed {
            padding-left: 4rem;
        }

        /* Hover effect untuk icon saat collapsed */
        @media (min-width: 1024px) {
            .sidebar.collapsed .nav-item:hover {
                position: relative;
            }

            .sidebar.collapsed .nav-item:hover .tooltip {
                display: block;
            }

            .tooltip {
                display: none;
                position: absolute;
                left: 100%;
                top: 50%;
                transform: translateY(-50%);
                background: #1f2937;
                color: white;
                padding: 0.5rem;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                white-space: nowrap;
                margin-left: 0.5rem;
                z-index: 60;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Overlay (tidak berubah) -->
    <div id="overlay"
        class="fixed inset-0 bg-gray-800/60 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"
        style="z-index: 40;"></div>

    <!-- Sidebar dengan modifikasi untuk collapsible -->
    <aside id="sidebar"
        class="sidebar fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out"
        style="z-index: 50;">
        <div class="flex flex-col h-full">
            <!-- Logo dengan modifikasi untuk collapsed state -->
            <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                <a href="{{ route('landing_page_admin') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/wikrama-logo.png') }}" alt="Logo Wikrama" class="w-8 h-8">
                    <span class="text-lg font-semibold text-gray-800 sidebar-text">Data Siswa</span>
                </a>
            </div>

            <!-- Navigation dengan tooltip -->
            <nav class="flex-1 overflow-y-auto p-4">
                <div class="space-y-2">
                    <a href="{{ route('siswa.data') }}"
                        class="nav-item flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.data') ? 'nav-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-users w-5 h-5 mr-3"></i>
                        <span class="sidebar-text">Data Siswa</span>
                    </a>

                    <a href="{{ route('siswa.data.akun') }}"
                        class="nav-item flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('siswa.data.akun') ? 'nav-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-user-cog w-5 h-5 mr-3"></i>
                        <span class="sidebar-text">Kelola Akun</span>
                    </a>

                    <a href="#"
                        class="nav-item flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fa-solid fa-chart-bar w-5 h-5 mr-3"></i>
                        <span class="sidebar-text">Analisis</span>
                    </a>

                    <a href="#"
                        class="nav-item flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fa-solid fa-cogs w-5 h-5 mr-3"></i>
                        <span class="sidebar-text">Pengaturan</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Button -->
            @if (Auth::check())
                <div class="border-t border-gray-200 p-4">
                    <button onclick="confirmLogout(event)"
                        class="nav-item flex items-center w-full px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-red-50 transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket w-5 h-5 mr-3"></i>
                        <span class="sidebar-text">Keluar</span>
                    </button>
                </div>
            @endif
        </div>
    </aside>

    <!-- Main Content dengan padding yang dinamis -->
    <div id="main" class="main-content lg:pl-64">
        <!-- Header dengan toggle button -->
        <header class="sticky top-0 bg-white border-b border-gray-200" style="z-index: 30;">
            <div class="flex items-center h-16 px-4">
                <!-- Mobile menu button -->
                <button id="menuButton" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 lg:hidden"
                    aria-label="Toggle mobile menu">
                    <i class="fa-solid fa-bars w-6 h-6"></i>
                </button>

                <!-- Desktop sidebar toggle -->
                <button id="sidebarCollapseBtn" class="hidden lg:flex p-2 rounded-lg text-gray-600 hover:bg-gray-100"
                    aria-label="Toggle sidebar">
                    <i id="collapseIcon" class="fa-solid fa-bars w-6 h-6"></i>
                </button>

                <h1 class="ml-4 text-xl font-semibold text-gray-800">Dashboard</h1>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuButton = document.getElementById('menuButton');
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
        const mainContent = document.getElementById('main');
        const collapseIcon = document.getElementById('collapseIcon');
        const body = document.body;

        // State
        let isSidebarOpen = false;
        let isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        // Initialize collapsed state
        if (isSidebarCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('sidebar-collapsed');
            collapseIcon.classList.remove('fa-bars');
            collapseIcon.classList.add('fa-angles-right');
        }

        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            isSidebarOpen = !isSidebarOpen;

            if (isSidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('pointer-events-none');
                overlay.classList.add('opacity-100');
                body.classList.add('sidebar-open');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('pointer-events-none');
                overlay.classList.remove('opacity-100');
                body.classList.remove('sidebar-open');
            }
        }

        // Toggle Sidebar Collapse (Desktop)
        function toggleSidebarCollapse() {
            isSidebarCollapsed = !isSidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', isSidebarCollapsed);

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');

            // Toggle icon
            if (isSidebarCollapsed) {
                collapseIcon.classList.remove('fa-bars');
                collapseIcon.classList.add('fa-angles-right');
            } else {
                collapseIcon.classList.remove('fa-angles-right');
                collapseIcon.classList.add('fa-bars');
            }
        }

        // Event Listeners
        menuButton.addEventListener('click', toggleSidebar);
        sidebarCollapseBtn.addEventListener('click', toggleSidebarCollapse);
        overlay.addEventListener('click', toggleSidebar);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && isSidebarOpen) {
                toggleSidebar();
            }
        });

        // Logout confirmation (tidak berubah)
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

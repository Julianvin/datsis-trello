<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Data Siswa</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-gray-50">

    <div class="flex min-h-full">

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
        @elseif (Session::has('failed'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Huhh...!",
                        text: "{{ Session::get('failed') }}",
                        icon: "error",
                        position: "top",
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                    });
                });
            </script>
        @endif

        <!-- Right side - Login Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img class="h-12 w-auto mx-auto" src="{{ asset('assets/images/wikrama-logo.png') }}"
                        alt="Wikrama Logo">
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900 text-center">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600 text-center">
                        Or
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            create a new account
                        </a>
                    </p>
                </div>

                <div class="mt-8">

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">
                                Username or Email
                            </label>
                            <div class="mt-1">
                                <input id="username" name="username" type="text" autocomplete="username" required
                                    value="{{ old('username') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter your username or email">
                            </div>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter your password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword()"
                                        class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                                        <i id="toggleIcon" class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                    Remember me
                                </label>
                            </div>

                            {{-- <div class="text-sm">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Forgot your password?
                                    </a>
                                </div> --}}
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- right side - Image -->
        <div class="flex-1 hidden lg:block bg-white rounded-lg shadow-lg p-4">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Selamat Datang di Data Siswa</h2>
                <p class="mt-2 text-sm text-gray-600">Sistem Informasi Data Siswa yang dibuat oleh PPLG SMK Wikrama Bogor</p>
            </div>
            <img class="w-full mt-4" src="{{ asset('assets/images/wikrama-logo.png') }}"
                alt="Background Image">
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Initialize AOS
        AOS.init();
    </script>
</body>

</html>

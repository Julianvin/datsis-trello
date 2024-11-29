<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Data Siswa</title>
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

        <!-- Right side - Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="text-center">
                    <img class="mx-auto h-12 w-auto" src="{{ asset('assets/images/wikrama-logo.png') }}"
                        alt="Wikrama Logo">
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Create your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Or
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">sign in to your
                            existing account</a>
                    </p>
                </div>

                <div class="mt-8">

                    <div class="mt-6">
                        <form action="{{ route('register.process') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1">
                                    <input id="nama" name="nama" type="text" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="John Doe">
                                </div>
                                @error('nama')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                                <div class="mt-1">
                                    <input id="nis" name="nis" type="text" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="12345678">
                                </div>
                                @error('nis')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div>
                                    <label for="rayon" class="block text-sm font-medium text-gray-700">Rayon</label>
                                    <div class="mt-1">
                                        <input id="rayon" name="rayon" type="text" required
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Cisarua 6">
                                    </div>
                                    @error('rayon')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="rombel" class="block text-sm font-medium text-gray-700">Rombel</label>
                                    <div class="mt-1">
                                        <input id="rombel" name="rombel" type="text" required
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="PPLG XI-2">
                                    </div>
                                    @error('rombel')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="you@example.com">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="mt-1 relative">
                                    <input id="password" name="password" type="password"
                                        autocomplete="new-password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="••••••••">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                                            onclick="togglePasswordVisibility()">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1 text-sm text-gray-500" id="password-strength"></div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Confirm password</label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        autocomplete="new-password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="••••••••">
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Profile
                                    Picture</label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="gambar"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="gambar" name="gambar" type="file" accept="image/*"
                                                    class="sr-only" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                                @error('gambar')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
                                    Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left side - Image -->
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
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.querySelector(".fa-eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            var strength = 0;

            if (password.match(/[a-z]+/)) {
                strength += 1;
            }
            if (password.match(/[A-Z]+/)) {
                strength += 1;
            }
            if (password.match(/[0-9]+/)) {
                strength += 1;
            }
            if (password.match(/[$@#&!]+/)) {
                strength += 1;
            }

            var strengthIndicator = document.getElementById('password-strength');

            switch (strength) {
                case 0:
                    strengthIndicator.textContent = "Very Weak";
                    strengthIndicator.style.color = "#ff0000";
                    break;
                case 1:
                    strengthIndicator.textContent = "Weak";
                    strengthIndicator.style.color = "#ff6600";
                    break;
                case 2:
                    strengthIndicator.textContent = "Fair";
                    strengthIndicator.style.color = "#ffcc00";
                    break;
                case 3:
                    strengthIndicator.textContent = "Good";
                    strengthIndicator.style.color = "#99cc00";
                    break;
                case 4:
                    strengthIndicator.textContent = "Strong";
                    strengthIndicator.style.color = "#00cc00";
                    break;
            }
        });
    </script>
</body>

</html>

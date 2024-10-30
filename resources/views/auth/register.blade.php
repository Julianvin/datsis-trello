<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Register</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!-- AOS resources -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- sweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0" data-aos="fade-up"
            data-aos-duration="1000">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
                data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8" data-aos="fade-up" data-aos-delay="400"
                    data-aos-duration="1200">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Register Akun Mu
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register.process') }}" method="POST">
                        @csrf
                        <div data-aos="fade-right" data-aos-delay="300" data-aos-duration="1000">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="name" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="nama..." value="{{ old('name') }}" required="">
                            @error('name')
                                <div class="bg-red-500 rounded-lg">{{ $message }}</div>
                            @enderror
                        </div>

                        <div data-aos="fade-right" data-aos-delay="450" data-aos-duration="1000">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@example.com" value="{{ old('email') }}" required="">
                            @error('email')
                                <div class="bg-red-500 rounded-lg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div data-aos="fade-right" data-aos-delay="550" data-aos-duration="1000">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <span class="absolute inset-y-0 right-3 flex items-center">
                                    <i id="toggleIcon" class="bi-eye-slash-fill text-xl text-white cursor-pointer"
                                        onclick="togglePassword()"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="bg-red-500 rounded-lg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div data-aos="fade-right" data-aos-delay="650" data-aos-duration="1000">
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <span class="absolute inset-y-0 right-3 flex items-center">
                                    <i id="toggleIconC" class="bi-eye-slash-fill text-xl text-white cursor-pointer"
                                        onclick="togglePasswordConfirm()"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="bg-red-500 rounded-lg">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" data-aos="zoom-in" data-aos-delay="1400" data-aos-duration="1000"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Create an account
                        </button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400" >
                            sudah punya akun?<a href="/"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                                disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>


    {{-- javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pages/register.js') }}"></script>
    <!-- AOS resources -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>

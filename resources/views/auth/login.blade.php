{{-- @extends('layouts.layout')

@section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama-logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!-- AOS resources -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- sweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
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


    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12 bg-gray-50 dark:bg-gray-900">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto" data-aos="zoom-in-up" data-aos-duration="800">
            <div
                class="absolute inset-0 bg-gradient-to-r from-gray-400 to-gray-700 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <form action="{{ route('login.process') }}" method="POST" class="max-w-md mx-auto space-y-6"
                    data-aos="fade-up" data-aos-duration="800">
                    @csrf
                    <div class="max-w-md mx-auto">
                        <div>
                            <h1 class="text-2xl font-semibold">Sign In</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input autocomplete="off" id="username" name="username" type="text"
                                        value="{{ old('username') }}"
                                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600"
                                        placeholder="Email address" />
                                    <label for="username"
                                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Username/Email</label>
                                    @error('username')
                                        <div class="invalid-feedback text-red-500" data-aos="fade-right"
                                            data-aos-duration="600">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- password --}}
                                <div class="relative">
                                    <div class="flex items-center">
                                        <input autocomplete="off" id="password" name="password" type="password"
                                            class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600"
                                            placeholder="" />
                                        <span class="ml-2 toggle-password text-xl text-gray-900" onclick="togglePassword()">
                                            <i id="toggleIcon" class="bi-eye-slash-fill hover:cursor-pointer hover:text-gray-900 transition duration-300 ease-in-out"></i>
                                        </span>
                                    </div>
                                    <label for="password"
                                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">••••••••</label>
                                    @error('password')
                                        <div class="text-red-500" data-aos="fade-right" data-aos-duration="600">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="relative">
                                    <button
                                        class="w-full bg-cyan-500 text-white rounded-md px-2 py-1 hover:bg-cyan-600 transition duration-300 ease-in-out">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="my-4 border-gray-300">
                <p class="text-center">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-cyan-500 underline">Register</a>
                </p>
            </div>
        </div>
    </div>


    {{-- javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pages/login.js') }}"></script>
    <!-- AOS resources -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>

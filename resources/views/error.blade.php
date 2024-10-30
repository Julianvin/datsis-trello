<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div>
        <div>
            <span class='error-num'>4</span><span class='error-num'>0</span><span class='error-num'>4</span>
            <div class='eye'></div>
            <div class='eye'></div>
            <p class='sub-text'>Waduh!!.Ada kesalahan. Kami sedang <i>menyelidiki</i> nya.</p>

            @if (Session::has('message'))
                <p class="error-message">{{ session('message') }}</p>
            @endif

            @if (auth()->check())
                <p class="user-info">Heii... Kamu masuk sebagai: <span class="user-auth">"{{ auth()->user()->name }}"</span>.</p>
            @else
                <p class="user-info">Sepertinya Kamu belum Login!.</p>
            @endif

            <button id="back-button" onclick="goBack()">Kembali ke Halaman Sebelumnya</button>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pages/error.js') }}"></script>
</body>

</html>

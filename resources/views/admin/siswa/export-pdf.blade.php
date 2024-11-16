<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Siswa</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Detail Siswa</h2>
        </div>

        <div class="profile-picture">
            <img src="{{ public_path('/storage/assets/images/' . $siswa->gambar) }}" alt="Foto {{ $siswa->nama }}">
        </div>

        <div class="details">
            <p><span>ID:</span> {{ $siswa->id }}</p>
            <p><span>Nama:</span> {{ $siswa->nama }}</p>
            <p><span>NIS:</span> {{ $siswa->nis }}</p>
            <p><span>Rayon:</span> {{ $siswa->rayon }}</p>
            <p><span>Rombel:</span> {{ $siswa->rombel }}</p>
        </div>
    </div>
</body>
</html>

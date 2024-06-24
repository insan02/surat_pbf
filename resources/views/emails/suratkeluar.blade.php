<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Masuk Baru</title>
</head>
<body>
    <h1>Surat Masuk Baru</h1>
    <p>Anda telah menerima surat baru dari: {{ $pengirim }}</p>
    <ul>
        <li>Kategori: {{ $kategori }}</li>
        <li>Keterangan: {{ $keterangan }}</li>
    </ul>
</body>
</html>

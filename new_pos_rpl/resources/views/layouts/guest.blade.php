<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('images/sunny.png'); /* Ganti dengan path gambar Anda */
            background-size: cover; /* Atur agar gambar menutupi seluruh area */
            background-position: center; /* Posisikan gambar di tengah */
            background-repeat: no-repeat; /* Hindari pengulangan gambar */
            font-family: 'figtree', sans-serif;
        }

        .container {
            max-width: 40px; /* Sesuaikan lebar kontainer sesuai kebutuhan */
            width: 100%;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9); /* Sesuaikan warna latar kontainer dengan transparansi */
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15); /* Efek bayangan */
            border-radius: 12px; /* Rounding corners */
            backdrop-filter: blur(10px); /* Efek blur pada latar belakang kontainer */
            animation: fadeIn 1s ease-in-out; /* Animasi fade in */
        }

        /* Animasi fade in */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Styling untuk link */
        a {
            text-decoration: none;
            color: #333333; /* Warna teks untuk link */
            text-align: center; /* Menengahkan teks horizontal */
            display: block; /* Membuat link menjadi blok sehingga dapat menerapkan margin secara horizontal */
            transition: color 0.3s ease; /* Transisi warna saat dihover */
        }

        a:hover {
            color: #555555; /* Warna teks saat link dihover */
        }

        /* Menengahkan gambar */
        .logo {
            margin: 0 auto; /* Menengahkan gambar secara horizontal */
            width: 80px;
            height: 80px;
            fill: #4A5568; /* Warna logo */
            transition: fill 0.3s ease; /* Transisi warna saat dihover */
        }

        .logo:hover {
            fill: #2D3748; /* Warna logo saat dihover */
        }

        /* Menengahkan teks */
        .text {
            font-size: 20px;
            text-align: center; /* Menengahkan teks horizontal */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px; /* Margin atas untuk teks */
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <a href="/">
            <x-application-logo class="logo" />
        </a>
    </div>

    <div class="mt-6 text">
        {{ $slot }}
    </div>
</div>
</body>
</html>

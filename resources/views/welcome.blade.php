<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Perpustakaan Arcadia</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f7fafc;
            color: #000000;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
        }

        .title {
            font-size: 3rem;
            font-weight: 700;
            color: #2d3748;
        }

        .subtitle {
            font-size: 1.25rem;
            color: #718096;
            margin-top: 1rem;
            margin-bottom: 3rem;
        }

        .cta-button {
            display: inline-block;
            background-color: #4299e1;
            color: #ffffff;
            padding: 1rem 2.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            margin: 0 0.5rem;
        }

        .cta-button:hover {
            background-color: #2b6cb0;
        }

        .cta-button-secondary {
            background-color: #e2e8f0;
            color: #2d3748;
        }

        .cta-button-secondary:hover {
            background-color: #cbd5e0;
        }

        .footer {
            margin-top: 4rem;
            font-size: 0.9rem;
            color: #a0aec0;
        }
    </style>
</head>

<body>
    <div class="text-center px-32 mx-auto py-20">
        <div class="title">
            Selamat Datang di Arcadia
        </div>
        <div class="subtitle">
            Sistem Peminjaman Buku Drive-Thru. Pesan online, ambil di jalan.
        </div>

        {{-- Tombol ini akan berfungsi jika Anda sudah setup rute login & register --}}
        <div>
            @auth
                {{-- Jika user sudah login --}}
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.pinjam.index') }}" class="cta-button">Dasbor Admin</a>
                @else
                    <a href="{{ route('buku.index') }}" class="cta-button">Lihat Daftar Buku</a>
                @endif
            @else
                {{-- Jika user belum login --}}
                <a href="{{ route('login') }}" class="cta-button">Login</a>
                <a href="{{ route('register') }}" class="cta-button cta-button-secondary">Register</a>
            @endauth
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Perpustakaan Arcadia. David Chandra 082111633090
        </div>
    </div>
</body>

</html>
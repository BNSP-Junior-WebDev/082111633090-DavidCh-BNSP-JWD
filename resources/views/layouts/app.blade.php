<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Perpustakaan Arcadia</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style>
        body { font-family: sans-serif; margin: 2em; }
        nav { background: #f0f0f0; padding: 1em; margin-bottom: 2em; }
        nav a { margin-right: 1em; text-decoration: none; color: #333; }
        .container { max-width: 1000px; margin: auto; }
        .book-grid, .borrow-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1em; }
        .book-card, .borrow-card { border: 1px solid #ddd; padding: 1em; }
        .status { font-weight: bold; }
        .status-DIPROSES { color: orange; }
        .status-DISETUJUI { color: green; }
        .status-DITOLAK { color: red; }
        .status-SELESAI { color: blue; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="flex justify-between items-center rounded-xl mx-8 ">
            <div>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('buku.index') }}">Daftar Buku</a>
                <a href="{{ route('pinjam.index') }}">Riwayat Pinjam</a>
            </div>
            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #333; cursor: pointer; text-decoration: underline; font-family: sans-serif; font-size: 1em;">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>

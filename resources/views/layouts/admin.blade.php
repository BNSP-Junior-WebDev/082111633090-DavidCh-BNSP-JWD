<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Perpustakaan Arcadia</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background-color: #f9f9f9; }
        nav { background: #333; padding: 1em; margin-bottom: 2em; }
        nav a { margin-right: 1em; text-decoration: none; color: #fff; }
        .container { max-width: 1200px; margin: auto; background: #fff; padding: 2em; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .status { font-weight: bold; }
        .status-DIPROSES { color: orange; }
        .status-DISETUJUI { color: green; }
        .status-DITOLAK { color: red; }
        .status-SELESAI { color: blue; }
        .action-btn { background-color: #4CAF50; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-right: 5px; border: none; cursor: pointer;}
        .btn-reject { background-color: #f44336; }
        .btn-return { background-color: #008CBA; }
        .btn-view { background-color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <nav style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('admin.pinjam.index') }}">Manajemen Peminjaman</a>
            </div>
            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; text-decoration: underline; font-family: sans-serif; font-size: 1em;">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>

        <main>
            @if(session('success'))
                <div style="color: green; margin-bottom: 1em;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="color: red; margin-bottom: 1em;">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>

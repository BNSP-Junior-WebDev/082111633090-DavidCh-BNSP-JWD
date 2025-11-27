@extends('layouts.app')

@section('content')
    <h1>Buat Pesanan Peminjaman Baru</h1>
    <p>Pilih buku yang ingin Anda pinjam di bawah ini, lalu klik tombol "Buat Pesanan".</p>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1em;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pinjam.store') }}" method="POST">
        @csrf

        <h3>Pilih Buku:</h3>
        <div class="book-grid">
            @forelse ($books as $book)
                <div class="book-card">
                    <label>
                        <input type="checkbox" name="book_ids[]" value="{{ $book->id_buku }}">
                        <strong>{{ $book->judul_buku }}</strong><br>
                        <small>Pengarang: {{ $book->nama_pengarang }}</small>
                    </label>
                </div>
            @empty
                <p>Tidak ada buku yang bisa dipinjam saat ini.</p>
            @endforelse
        </div>

        @if($books->isNotEmpty())
            <button type="submit" style="margin-top: 1em; padding: 0.5em 1em;">Buat Pesanan</button>
        @endif
    </form>
@endsection

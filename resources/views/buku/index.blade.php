@extends('layouts.app')

@section('content')
    <h1>Daftar Buku Tersedia</h1>
    <p>Pilih buku yang ingin Anda pinjam, lalu buat pesanan peminjaman.</p>
    <a href="{{ route('pinjam.create') }}" style="margin-bottom: 1em; display: inline-block;">Buat Pesanan Peminjaman Baru</a>

    @if(session('success'))
        <div style="color: green; margin-bottom: 1em;">{{ session('success') }}</div>
    @endif
    
    <div class="book-grid">
        @forelse ($books as $book)
            <div class="book-card">
                <h3>{{ $book->judul_buku }}</h3>
                <p><strong>Penulis:</strong> {{ $book->nama_pengarang }}</p>
            </div>
        @empty
            <p>Tidak ada buku yang tersedia saat ini.</p>
        @endforelse
    </div>

    <div style="margin-top: 2em;">
        {{ $books->links() }}
    </div>
@endsection

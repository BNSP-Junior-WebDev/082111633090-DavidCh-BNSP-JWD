@extends('layouts.app')

@section('content')
    <h1>Riwayat Peminjaman Anda</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 1em;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pinjam.create') }}" style="margin-bottom: 1em; display: inline-block;">Buat Pesanan Peminjaman
        Baru</a>

    <div class="borrow-list">
        @forelse ($borrowings as $borrowing)
            <div class="borrow-card">
                <h3>Kode: {{ $borrowing->kode_pinjam }}</h3>
                <p>Tanggal Pesan: {{ $borrowing->created_at->format('d M Y') }}</p>
                <p>Status: <span class="status status-{{$borrowing->status_pinjam}}">{{ $borrowing->status_pinjam }}</span></p>

                <h4>Buku yang dipinjam:</h4>
                <ul>
                    @foreach($borrowing->books as $book)
                        <li>{{ $book->judul_buku }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('pinjam.edit', $borrowing->kode_pinjam) }}">
                    Edit Peminjaman
                </a>
            </div>
        @empty
            <p>Anda belum pernah melakukan peminjaman.</p>
        @endforelse
    </div>

    <!-- Tampilkan link paginasi -->
    <div style="margin-top: 2em;">
        {{ $borrowings->links() }}
    </div>
@endsection
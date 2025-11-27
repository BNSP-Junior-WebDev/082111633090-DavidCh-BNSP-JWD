@extends('layouts.app')

@section('content')
    <h1>Edit Peminjaman: {{ $borrowing->kode_pinjam }}</h1>

    <p>Status: <strong>{{ $borrowing->status_pinjam }}</strong></p>
    <p>Tanggal Pesan: {{ $borrowing->created_at->format('d M Y') }}</p>

    <h3>Daftar Buku</h3>

    @if(session('success'))
        <div style="color: green; margin-bottom: 1em;">{{ session('success') }}</div>
    @endif

    <ul>
        @forelse ($borrowing->books as $book)
            <li style="margin-bottom: 10px;">
                <strong>{{ $book->judul_buku }}</strong>  
                <form action="{{ route('pinjam.book.remove', ['borrowing' => $borrowing->kode_pinjam, 'book' => $book->id_buku]) }}"
                      method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red; margin-left: 10px;">
                        Hapus
                    </button>
                </form>
            </li>
        @empty
            <p>Tidak ada buku dalam peminjaman ini.</p>
        @endforelse
    </ul>

    <a href="{{ route('pinjam.index') }}">← Kembali ke Riwayat</a>
@endsection
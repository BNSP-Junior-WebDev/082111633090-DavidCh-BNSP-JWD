@extends('layouts.admin')

@section('content')
    <h1>Detail Peminjaman: {{ $borrowing->kode_pinjam }}</h1>

    <a href="{{ route('admin.pinjam.index') }}">&larr; Kembali ke Daftar Peminjaman</a>

    <div style="margin-top: 2em;">
        <h3>Informasi Peminjaman</h3>
        <p><strong>Peminjam:</strong> {{ $borrowing->peminjam->name }} ({{ $borrowing->peminjam->email }})</p>
        <p><strong>Tanggal Pesan:</strong> {{ $borrowing->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Status:</strong> <span
                class="status status-{{$borrowing->status_pinjam}}">{{ $borrowing->status_pinjam }}</span></p>
        @if($borrowing->tanggal_pinjam)
            <p><strong>Tanggal Disetujui:</strong> {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d M Y') }}</p>
        @endif
        @if($borrowing->tanggal_kembali)
            <p><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d M Y') }}</p>
        @endif
    </div>

    <div style="margin-top: 2em;">
        <h3>Daftar Buku</h3>
        <ul>
            @foreach($borrowing->books as $book)
                <li>
                    {{ $book->judul_buku }} (Penulis: {{ $book->nama_pengarang }})

                    {{-- Tombol untuk menghapus buku dari peminjaman --}}
                    @if($borrowing->status_pinjam == 'diproses')
                        <form action="{{ route('admin.pinjam.book.remove', ['borrowing' => $borrowing->kode_pinjam, 'book' => $book->id_buku]) }}"
                            method="POST" style="display:inline; margin-left:10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-reject" style="padding: 2px 6px; font-size: 12px;">
                                Hapus
                            </button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div style="margin-top: 2em; border-top: 1px solid #ddd; padding-top: 1em;">
        <h3>Aksi</h3>

        {{-- Tampilkan tombol Aksi hanya jika statusnya relevan --}}

        @if($borrowing->status_pinjam == 'diproses')
            <form action="{{ route('admin.pinjam.approve', $borrowing) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="action-btn">Setujui Peminjaman</button>
            </form>
            <form action="{{ route('admin.pinjam.reject', $borrowing) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="action-btn btn-reject">Tolak Peminjaman</button>
            </form>
        @elseif($borrowing->status_pinjam == 'disetujui')
            <form action="{{ route('admin.pinjam.return', $borrowing) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="action-btn btn-return">Tandai Sudah Dikembalikan</button>
            </form>
        @else
            <p>Tidak ada aksi yang bisa dilakukan untuk status ini.</p>
        @endif
    </div>

@endsection
@extends('layouts.admin')

@section('content')
    <h1>Manajemen Peminjaman</h1>
    <p>Berikut adalah daftar semua transaksi peminjaman yang ada di sistem.</p>

    <table>
        <thead>
            <tr>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->kode_pinjam }}</td>
                    <td>{{ $borrowing->peminjam->name }}</td>
                    <td>{{ $borrowing->created_at->format('d M Y, H:i') }}</td>
                    <td><span class="status status-{{$borrowing->status_pinjam}}">{{ $borrowing->status_pinjam }}</span></td>
                    <td>
                        <a href="{{ route('admin.pinjam.show', $borrowing) }}" class="action-btn btn-view">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tampilkan link paginasi -->
    <div style="margin-top: 2em;">
        {{ $borrowings->links() }}
    </div>
@endsection

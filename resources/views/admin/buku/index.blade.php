@extends('layouts.admin')

@section('content')
<h1>Manajemen Buku</h1>

<a href="{{ route('admin.buku.create') }}" class="action-btn" style="margin-bottom: 1em; display:inline-block;">
    + Tambah Buku
</a>

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tanggal Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->judul_buku }}</td>
            <td>{{ $book->nama_pengarang }}</td>
            <td>{{ $book->nama_penerbit }}</td>
            <td>{{ $book->tgl_terbit }}</td>
            <td>
                <a href="{{ route('admin.buku.edit', $book) }}" class="action-btn">Edit</a>

                <form action="{{ route('admin.buku.destroy', $book) }}"
                      method="POST"
                      style="display:inline;"
                      onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn-reject">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 1em;">
    {{ $books->links() }}
</div>
@endsection
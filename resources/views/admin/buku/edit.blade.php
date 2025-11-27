@extends('layouts.admin')

@section('content')
<h1>Edit Buku</h1>

<form method="POST" action="{{ route('admin.buku.update', $book) }}">
    @csrf
    @method('PUT')

    <label>Judul Buku</label>
    <input type="text" name="judul_buku" value="{{ $book->judul_buku }}" required>

    <label>Nama Pengarang</label>
    <input type="text" name="nama_pengarang" value="{{ $book->nama_pengarang }}" required>

    <label>Nama Penerbit</label>
    <input type="text" name="nama_penerbit" value="{{ $book->nama_penerbit }}" required>

    <label>Tanggal Terbit</label>
    <input type="date" name="tgl_terbit" value="{{ $book->tgl_terbit }}" required>

    <button type="submit" class="action-btn">Update</button>
</form>
@endsection
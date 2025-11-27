@extends('layouts.admin')

@section('content')
<h1>Tambah Buku</h1>

<form method="POST" action="{{ route('admin.buku.store') }}">
    @csrf

    <label>Judul Buku</label>
    <input type="text" name="judul_buku" required>

    <label>Nama Pengarang</label>
    <input type="text" name="nama_pengarang" required>

    <label>Nama Penerbit</label>
    <input type="text" name="nama_penerbit" required>

    <label>Tanggal Terbit</label>
    <input type="date" name="tgl_terbit" required>

    <button type="submit" class="action-btn">Simpan</button>
</form>
@endsection
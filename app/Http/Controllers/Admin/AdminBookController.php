<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('judul_buku')->paginate(10);
        return view('admin.buku.index', compact('books'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required',
            'nama_pengarang' => 'required',
            'nama_penerbit' => 'required',
            'tgl_terbit' => 'required|date',
        ]);

        Book::create($validated);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('admin.buku.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul_buku' => 'required',
            'nama_pengarang' => 'required',
            'nama_penerbit' => 'required',
            'tgl_terbit' => 'required|date',
        ]);

        $book->update($validated);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        // Cek apakah buku sedang dipinjam?
        if ($book->borrowings()->exists()) {
            return back()->with('error', 'Buku sedang dalam peminjaman dan tidak bisa dihapus.');
        }

        $book->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
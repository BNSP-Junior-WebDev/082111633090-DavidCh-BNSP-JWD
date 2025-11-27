<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     * Halaman ini bisa diakses oleh Peminjam untuk melihat buku yang tersedia.
     */
    public function index()
    {
        // Mengambil semua data buku dari database
        $books = Book::orderBy('judul_buku')->paginate(10);

        // Mengirim data buku ke view 'buku.index'
        return view('buku.index', ['books' => $books]);
    }
}

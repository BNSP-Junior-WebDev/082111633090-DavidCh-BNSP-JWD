<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    /**
     * Menampilkan riwayat peminjaman milik user yang sedang login.
     */
    public function index()
    {
        // Mengambil data peminjaman milik user yang sedang login, diurutkan dari yang terbaru
        $userBorrowings = Borrowing::where('id_peminjam', Auth::id())
            ->with('books') // Eager load relasi buku untuk efisiensi
            ->latest()
            ->paginate(10);

        return view('pinjam.index', ['borrowings' => $userBorrowings]);
    }

    /**
     * Menampilkan form untuk membuat pesanan peminjaman baru.
     * Form ini akan berisi daftar buku yang bisa dipilih.
     */
    public function create()
    {
        // Mengambil semua buku
        $books = Book::orderBy('judul_buku')->get();

        return view('pinjam.create', ['books' => $books]);
    }

    /**
     * Menyimpan data pesanan peminjaman baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input: minimal harus memilih 1 buku
        $request->validate([
            'book_ids' => 'required|array|min:1',
        ]);

        // Membuat data peminjaman baru
        $borrowing = Borrowing::create([
            'kode_pinjam' => 'ARC-' . strtoupper(Str::random(8)), // Membuat kode pinjam unik
            'id_peminjam' => Auth::id(),
            'status_pinjam' => 'diproses',
            'tgl_wajibkembali' => Carbon::now()->addDays(7),
        ]);

        // Meng-attach buku-buku yang dipilih ke dalam peminjaman
        $borrowing->books()->attach($request->book_ids);

        // Redirect ke halaman riwayat peminjaman dengan pesan sukses
        return redirect()->route('pinjam.index')->with('success', 'Pesanan peminjaman berhasil dibuat!');
    }
    public function removeBook(Borrowing $borrowing, Book $book)
    {
        // Copot relasi di pivot
        $borrowing->books()->detach($book->id_buku);

        return back()->with('success', 'Buku berhasil dihapus dari daftar peminjaman.');
    }
    public function edit(Borrowing $borrowing)
    {
        // Pastikan hanya pemilik pinjaman yang boleh edit
        if ($borrowing->id_peminjam !== Auth::id()) {
            abort(403);
        }

        $borrowing->load('books');

        return view('pinjam.edit', ['borrowing' => $borrowing]);
    }
}

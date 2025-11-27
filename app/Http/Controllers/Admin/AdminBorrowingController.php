<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBorrowingController extends Controller
{
    /**
     * Menampilkan daftar semua peminjaman.
     */
    public function index()
    {
        // Mengambil semua data peminjaman dengan relasi user dan books
        $borrowings = Borrowing::with(['peminjam', 'admin', 'books'])->latest()->paginate(10);
        return view('admin.pinjam.index', ['borrowings' => $borrowings]);
    }

    /**
     * Menampilkan detail sebuah peminjaman.
     */
    public function show(Borrowing $borrowing)
    {
        // View-nya akan menampilkan detail dan tombol approve/reject
        return view('admin.pinjam.show', ['borrowing' => $borrowing]);
    }

    /**
     * Menyetujui sebuah peminjaman.
     */
    public function approve(Borrowing $borrowing)
    {
        if ($borrowing->status_pinjam === 'diproses') {
            $borrowing->update([
                'status_pinjam' => 'disetujui',
                'tanggal_pinjam' => Carbon::now(),
            ]);
            return redirect()->route('admin.pinjam.index')->with('success', 'Peminjaman telah disetujui.');
        }

        return redirect()->route('admin.pinjam.index')->with('error', 'Aksi tidak valid.');
    }

    public function reject(Borrowing $borrowing)
    {
        if ($borrowing->status_pinjam === 'diproses') {
            $borrowing->update([
                'status_pinjam' => 'ditolak'
            ]);
            return redirect()->route('admin.pinjam.index')->with('success', 'Peminjaman telah ditolak.');
        }

        return redirect()->route('admin.pinjam.index')->with('error', 'Aksi tidak valid.');
    }

    public function return(Borrowing $borrowing)
    {
        if ($borrowing->status_pinjam === 'disetujui') {
            $borrowing->update([
                'status_pinjam' => 'selesai',
                'tanggal_kembali' => Carbon::now(),
            ]);
            return redirect()->route('admin.pinjam.index')->with('success', 'Peminjaman telah selesai (buku dikembalikan).');
        }

        return redirect()->route('admin.pinjam.index')->with('error', 'Aksi tidak valid.');
    }

    /**
     * Menghapus satu buku dari peminjaman.
     */
    public function removeBook(Borrowing $borrowing, Book $book)
    {
        // Pastikan buku tersebut ada di pivot
        if (!$borrowing->books()
            ->where('detil_peminjaman.id_buku', $book->id_buku)
            ->exists()) {
            return back()->with('error', 'Buku tidak ditemukan dalam peminjaman ini.');
        }

        // Hapus dari pivot
        $borrowing->books()->detach($book->id_buku);

        return back()->with('success', 'Buku berhasil dihapus dari peminjaman.');
    }
}

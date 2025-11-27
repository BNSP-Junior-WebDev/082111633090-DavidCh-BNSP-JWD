<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\Admin\AdminBorrowingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminBookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route utama, langsung arahkan ke halaman welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- GRUP ROUTE UNTUK OTENTIKASI ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- GRUP ROUTE UNTUK PEMINJAM ---
// Semua route di dalam grup ini hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Menampilkan daftar semua buku yang bisa dipinjam
    Route::get('/buku', [BookController::class, 'index'])->name('buku.index');

    // Menampilkan riwayat peminjaman milik user
    Route::get('/pinjam', [BorrowingController::class, 'index'])->name('pinjam.index');

    // Menampilkan form untuk membuat pesanan peminjaman baru
    Route::get('/pinjam/create', [BorrowingController::class, 'create'])->name('pinjam.create');

    // Menyimpan data pesanan peminjaman baru
    Route::post('/pinjam', [BorrowingController::class, 'store'])->name('pinjam.store');

    // routes/web.php
    Route::get('/pinjam/{borrowing}/edit', [BorrowingController::class, 'edit'])
        ->name('pinjam.edit');

    Route::delete('/pinjam/{borrowing}/{book}', [BorrowingController::class, 'removeBook'])
        ->name('pinjam.book.remove');
});


// --- GRUP ROUTE UNTUK ADMIN ---
// Semua route di sini hanya bisa diakses oleh user yang sudah login DAN memiliki role 'admin'
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Menampilkan daftar peminjaman
        Route::get('/pinjam', [AdminBorrowingController::class, 'index'])->name('pinjam.index');

        // Detail peminjaman
        Route::get('/pinjam/{borrowing}', [AdminBorrowingController::class, 'show'])->name('pinjam.show');

        // Approve
        Route::post('/pinjam/{borrowing}/approve', [AdminBorrowingController::class, 'approve'])->name('pinjam.approve');

        // Reject
        Route::post('/pinjam/{borrowing}/reject', [AdminBorrowingController::class, 'reject'])->name('pinjam.reject');

        // Return
        Route::post('/pinjam/{borrowing}/return', [AdminBorrowingController::class, 'return'])->name('pinjam.return');

        // Hapus buku dari peminjaman
        Route::delete(
            '/pinjam/{borrowing}/book/{book}',
            [AdminBorrowingController::class, 'removeBook']
        )->name('pinjam.book.remove');

        // CRUD Buku
        Route::get('/buku', [AdminBookController::class, 'index'])->name('buku.index');
        Route::get('/buku/create', [AdminBookController::class, 'create'])->name('buku.create');
        Route::post('/buku', [AdminBookController::class, 'store'])->name('buku.store');
        Route::get('/buku/{book}/edit', [AdminBookController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{book}', [AdminBookController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{book}', [AdminBookController::class, 'destroy'])->name('buku.destroy');
    });

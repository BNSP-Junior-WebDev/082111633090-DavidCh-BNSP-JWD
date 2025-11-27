<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Definisikan primary key
    protected $primaryKey = 'id_buku';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul_buku',
        'tgl_terbit',
        'nama_pengarang',
        'nama_penerbit',
    ];

    /**
     * Relasi many-to-many dengan Borrowing.
     * Sebuah buku bisa ada di banyak transaksi peminjaman.
     */
    public function borrowings()
    {
        return $this->belongsToMany(Borrowing::class, 'detil_peminjaman', 'id_buku', 'kode_pinjam');
    }
}

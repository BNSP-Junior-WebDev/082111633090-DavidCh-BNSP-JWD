<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // Definisikan properti tabel
    protected $primaryKey = 'kode_pinjam';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_pinjam',
        'id_admin',
        'id_peminjam',
        'tgl_ambil',
        'tgl_wajibkembali',
        'tgl_kembali',
        'status_pinjam',
    ];

    /**
     * Relasi untuk user peminjam.
     */
    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }

    /**
     * Relasi untuk user admin.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    /**
     * Relasi many-to-many dengan Book.
     */
    public function books()
    {
        return $this->belongsToMany(
            Book::class,
            'detil_peminjaman',
            'kode_pinjam',  // foreign key ke Borrowing
            'id_buku',      // foreign key ke Book
            'kode_pinjam',  // local key Borrowing
            'id_buku'       // local key Book
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menyiapkan data 10 buku
        $books = [
            ['judul_buku' => 'Laskar Pelangi', 'nama_pengarang' => 'Andrea Hirata', 'nama_penerbit' => 'Bentang Pustaka', 'tgl_terbit' => '2005-01-01'],
            ['judul_buku' => 'Bumi Manusia', 'nama_pengarang' => 'Pramoedya Ananta Toer', 'nama_penerbit' => 'Hasta Mitra', 'tgl_terbit' => '1980-01-01'],
            ['judul_buku' => 'Negeri 5 Menara', 'nama_pengarang' => 'Ahmad Fuadi', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2009-01-01'],
            ['judul_buku' => 'Cantik Itu Luka', 'nama_pengarang' => 'Eka Kurniawan', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2002-01-01'],
            ['judul_buku' => 'Perahu Kertas', 'nama_pengarang' => 'Dee Lestari', 'nama_penerbit' => 'Bentang Pustaka', 'tgl_terbit' => '2009-01-01'],
            ['judul_buku' => 'Saman', 'nama_pengarang' => 'Ayu Utami', 'nama_penerbit' => 'KPG', 'tgl_terbit' => '1998-01-01'],
            ['judul_buku' => 'Pulang', 'nama_pengarang' => 'Leila S. Chudori', 'nama_penerbit' => 'KPG', 'tgl_terbit' => '2012-01-01'],
            ['judul_buku' => 'O', 'nama_pengarang' => 'Eka Kurniawan', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2016-01-01'],
            ['judul_buku' => 'Gadis Kretek', 'nama_pengarang' => 'Ratih Kumala', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2012-01-01'],
            ['judul_buku' => 'Laut Bercerita', 'nama_pengarang' => 'Leila S. Chudori', 'nama_penerbit' => 'KPG', 'tgl_terbit' => '2017-01-01'],
            ['judul_buku' => 'Sebuah Seni untuk Bersikap Bodo Amat', 'nama_pengarang' => 'Mark Manson', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2016-09-13'],
            ['judul_buku' => 'Filosofi Teras', 'nama_pengarang' => 'Henry Manampiring', 'nama_penerbit' => 'Kompas', 'tgl_terbit' => '2018-10-01'],
            ['judul_buku' => 'Tentang Kamu', 'nama_pengarang' => 'Tere Liye', 'nama_penerbit' => 'Republika', 'tgl_terbit' => '2016-10-01'],
            ['judul_buku' => 'Hujan', 'nama_pengarang' => 'Tere Liye', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2014-01-01'],
            ['judul_buku' => 'Ronggeng Dukuh Paruk', 'nama_pengarang' => 'Ahmad Tohari', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '1982-01-01'],
            ['judul_buku' => 'Lelaki Harimau', 'nama_pengarang' => 'Eka Kurniawan', 'nama_penerbit' => 'Gramedia Pustaka Utama', 'tgl_terbit' => '2004-01-01'],
            ['judul_buku' => 'Sirkus Pohon', 'nama_pengarang' => 'Andrea Hirata', 'nama_penerbit' => 'Bentang Pustaka', 'tgl_terbit' => '2017-01-01'],
            ['judul_buku' => 'Rectoverso', 'nama_pengarang' => 'Dee Lestari', 'nama_penerbit' => 'Bentang Pustaka', 'tgl_terbit' => '2008-01-01'],
            ['judul_buku' => 'Rumah Kaca', 'nama_pengarang' => 'Pramoedya Ananta Toer', 'nama_penerbit' => 'Hasta Mitra', 'tgl_terbit' => '1988-01-01'],
            ['judul_buku' => 'Orang-Orang Biasa', 'nama_pengarang' => 'Andrea Hirata', 'nama_penerbit' => 'Bentang Pustaka', 'tgl_terbit' => '2019-01-01'],
        ];

        // Memasukkan data ke dalam tabel 'books'
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user yang ada
        $peminjams = User::where('role', 'peminjam')->get();
        $admin = User::where('role', 'admin')->first();
        
        // Ambil buku yang ada
        $books = Book::all();

        if ($peminjams->isEmpty() || !$admin || $books->count() < 2) {
            $this->command->info('Tidak ada cukup data user atau buku untuk membuat seeder peminjaman.');
            return;
        }

        // Buat 5 data peminjaman
        for ($i = 0; $i < 5; $i++) {
            $peminjam = $peminjams->random();
            $book1 = $books->random();
            $book2 = $books->where('id_buku', '!=', $book1->id_buku)->random();

            $kode_pinjam = 'KP-' . strtoupper(Str::random(8));
            $tgl_pesan = Carbon::now()->subDays(rand(1, 30));

            $borrowing = Borrowing::create([
                'kode_pinjam' => $kode_pinjam,
                'id_admin' => $admin->id,
                'id_peminjam' => $peminjam->id,
                'tgl_ambil' => $tgl_pesan->copy()->addDays(1),
                'tgl_wajibkembali' => $tgl_pesan->copy()->addDays(8),
                'tgl_kembali' => null,
                'status_pinjam' => 'disetujui',
                'created_at' => $tgl_pesan,
                'updated_at' => $tgl_pesan,
            ]);

            // Tambah detail peminjaman
            DB::table('detil_peminjaman')->insert([
                ['kode_pinjam' => $kode_pinjam, 'id_buku' => $book1->id_buku],
                ['kode_pinjam' => $kode_pinjam, 'id_buku' => $book2->id_buku],
            ]);
        }
    }
}

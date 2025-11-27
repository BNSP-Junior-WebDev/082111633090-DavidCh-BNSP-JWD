<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 1 user sebagai Admin
        User::create([
            'name' => 'Admin Arcadia',
            'email' => 'admin@arcadia.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif', // Admin juga punya status
        ]);

        // Membuat 1 user sebagai Peminjam
        User::create([
            'name' => 'Peminjam User',
            'email' => 'peminjam@arcadia.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'status' => 'aktif',
        ]);

        // Membuat 10 user peminjam menggunakan factory
        User::factory(10)->create();

        // Memanggil BookSeeder untuk mengisi data buku
        $this->call(BookSeeder::class);

        // Memanggil BorrowingSeeder untuk mengisi data peminjaman
        $this->call(BorrowingSeeder::class);
    }
}

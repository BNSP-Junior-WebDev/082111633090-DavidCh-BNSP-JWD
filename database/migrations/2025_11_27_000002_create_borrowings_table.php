<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->string('kode_pinjam')->primary();

            // Foreign key untuk admin yang memproses, bisa null jika belum diproses
            $table->foreignId('id_admin')->nullable()->constrained('users')->onDelete('set null');
            
            // Foreign key untuk user yang meminjam
            $table->foreignId('id_peminjam')->constrained('users')->onDelete('cascade');

            $table->date('tgl_ambil')->nullable(); // Diisi saat buku diambil
            $table->date('tgl_wajibkembali'); // Ditentukan oleh admin saat persetujuan
            $table->date('tgl_kembali')->nullable(); // Diisi saat buku sudah dikembalikan

            // Status peminjaman: diproses, disetujui, ditolak, selesai
            $table->enum('status_pinjam', ['diproses', 'disetujui', 'ditolak', 'selesai'])->default('diproses');
            
            $table->timestamps(); // created_at akan jadi tgl_pesan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};

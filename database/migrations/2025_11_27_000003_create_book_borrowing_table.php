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
        Schema::create('detil_peminjaman', function (Blueprint $table) {
            // Foreign key ke tabel borrowings (peminjaman)
            $table->string('kode_pinjam');
            $table->foreign('kode_pinjam')->references('kode_pinjam')->on('borrowings')->onDelete('cascade');

            // Foreign key ke tabel books (buku)
            $table->unsignedBigInteger('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('books')->onDelete('cascade');

            // Menetapkan composite primary key
            $table->primary(['kode_pinjam', 'id_buku']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detil_peminjaman');
    }
};

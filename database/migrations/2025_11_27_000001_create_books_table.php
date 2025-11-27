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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_buku'); // Kolom ID utama
            $table->string('judul_buku'); // Kolom untuk judul buku
            $table->date('tgl_terbit'); // Kolom untuk tanggal terbit
            $table->string('nama_pengarang'); // Kolom untuk nama pengarang
            $table->string('nama_penerbit'); // Kolom untuk nama penerbit
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};

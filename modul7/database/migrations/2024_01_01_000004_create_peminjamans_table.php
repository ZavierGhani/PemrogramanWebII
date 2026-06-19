<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_buku');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->timestamps();

            $table->foreign('id_member')
                  ->references('id_member')->on('members')
                  ->onDelete('cascade');

            $table->foreign('id_buku')
                  ->references('id')->on('bukus')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
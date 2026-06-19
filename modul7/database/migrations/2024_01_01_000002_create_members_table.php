<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id('id_member');
            $table->string('nama_member', 250);
            $table->string('nomor_member', 15);
            $table->text('alamat');
            $table->dateTime('tgl_mendaftar');
            $table->date('tgl_terkahir_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
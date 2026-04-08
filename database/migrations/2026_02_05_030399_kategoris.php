<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) { // Ganti 'kategori' menjadi 'kategoris'
            $table->id();
            $table->string('nama_kategori', 100); // Tambah kolom nama_kategori
            $table->string('deskripsi', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoris'); // Ganti 'kategori' menjadi 'kategoris'
    }
};

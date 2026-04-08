<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) { // Ganti 'aspirasi' menjadi 'aspirasis'
            $table->id();
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('restrict');
            $table->string('lokasi', 50);
            $table->string('keterangan', 255);
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');

            // Index untuk performa query
            $table->index(['status', 'created_at']);
            $table->index(['siswa_id', 'created_at']);
            $table->index(['kategori_id', 'status']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis'); // Ganti sesuai create
    }
};

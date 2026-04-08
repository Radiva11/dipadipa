<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) { // Ganti 'feedback' menjadi 'feedbacks'
            $table->id();
            $table->foreignId('aspirasi_id')->constrained('aspirasis')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->text('feedback');

            // Index untuk performa
            $table->index(['aspirasi_id', 'created_at']);
            $table->index('admin_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks'); // Ganti sesuai create
    }
};

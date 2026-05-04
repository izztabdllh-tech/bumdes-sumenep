<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();

            // Konten utama
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');

            // Media
            $table->string('gambar')->nullable();

            // Meta
            $table->string('penulis')->nullable();
            $table->date('tanggal')->nullable();

            // Sosial media
            $table->string('link_instagram')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_youtube')->nullable();

            // Status
            $table->boolean('is_published')->default(true);

            $table->timestamps();

            // Index tambahan biar performa lebih bagus
            $table->index('slug');
            $table->index('is_published');
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
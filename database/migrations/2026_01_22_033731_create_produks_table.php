<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();

            $table->string('nama_produk');
            $table->string('kategori')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->year('tahun')->nullable();

            $table->string('bumdes_nama');
            $table->string('desa_nama');

            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable(); // path gambar

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

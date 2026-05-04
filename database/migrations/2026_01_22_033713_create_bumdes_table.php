<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bumdes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('desa_id')->constrained()->cascadeOnDelete();
        $table->string('nama_bumdes');
        $table->string('direktur')->nullable();
        $table->string('status_hukum')->nullable();
        $table->string('klasifikasi')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumdes');
    }
};
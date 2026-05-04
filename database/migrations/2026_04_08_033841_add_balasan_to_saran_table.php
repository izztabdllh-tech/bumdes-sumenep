<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sarans', function (Blueprint $table) {
            $table->text('balasan')->nullable();
            $table->boolean('is_read_user')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('sarans', function (Blueprint $table) {
            $table->dropColumn(['balasan', 'is_read_user']);
        });
    }
};
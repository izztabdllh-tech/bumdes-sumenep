<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukKetahananPangan extends Model
{
    protected $table = 'produk_ketahanan_pangan';
    protected $fillable = ['nama', 'gambar'];
}

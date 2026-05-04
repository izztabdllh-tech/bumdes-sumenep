<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

  protected $fillable = [
    'nama_produk',
    'bumdes_id',
    'foto',
    'kategori',
    'jenis_usaha',
    'tahun',
    'deskripsi',
];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
    'judul',
    'slug',
    'ringkasan',
    'isi',
    'gambar',
    'penulis',
    'tanggal',
    'link_instagram',
    'link_tiktok',
    'link_facebook',
    'link_youtube',
    'is_published',
];
}
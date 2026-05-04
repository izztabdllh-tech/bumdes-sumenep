<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bumdes extends Model
{
    protected $table = 'bumdes';

    protected $fillable = [
        'desa_id',
        'nama_bumdes',
        'direktur',
        'status_hukum',
        'klasifikasi',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}

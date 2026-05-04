<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $fillable = [
        'nama','kontak','kategori','pesan',
        'status','tanggapan','ditanggapi_pada','ditanggapi_oleh'
    ];
}

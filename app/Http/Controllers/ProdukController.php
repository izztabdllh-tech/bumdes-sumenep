<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukKetahananPangan;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    public function ketahananPangan()
    {
        $items = ProdukKetahananPangan::latest()->get();
        return view('produk.ketahanan-pangan', compact('items'));
    }

    public function unitUsaha()
    {
        return view('produk.unit-usaha');
    }
}

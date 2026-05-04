<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_published', 1)
            ->latest()
            ->get();

        return view('berita.index', compact('beritas'));
    }
}
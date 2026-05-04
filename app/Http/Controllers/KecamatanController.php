<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $kecamatans = Kecamatan::query()
            ->with(['desas' => function ($q) {
                $q->orderBy('nama_desa');
            }])
            ->withCount('desas')
            ->when($search, function ($q) use ($search) {
                $q->where('nama_kecamatan', 'like', "%{$search}%")
                  ->orWhereHas('desas', function ($qq) use ($search) {
                      $qq->where('nama_desa', 'like', "%{$search}%");
                  });
            })
            ->orderBy('nama_kecamatan')
            ->get();

        return view('kecamatan.index', compact('kecamatans'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bumdes;
use App\Models\Desa;
use Illuminate\Http\Request;

class BumdesCrudController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $data = Bumdes::with('desa.kecamatan')
            ->when($q, function ($query) use ($q) {
                $query->where('nama_bumdes', 'like', "%{$q}%")
                      ->orWhere('direktur', 'like', "%{$q}%")
                      ->orWhere('status_hukum', 'like', "%{$q}%")
                      ->orWhere('klasifikasi', 'like', "%{$q}%")
                      ->orWhereHas('desa', function ($q2) use ($q) {
                          $q2->where('nama_desa', 'like', "%{$q}%")
                             ->orWhereHas('kecamatan', function ($q3) use ($q) {
                                 $q3->where('nama_kecamatan', 'like', "%{$q}%");
                             });
                      });
            })
            ->orderBy('nama_bumdes')
            ->paginate(10)
            ->withQueryString();

        return view('admin.bumdes.index', compact('data', 'q'));
    }

    public function create()
    {
        $desas = Desa::with('kecamatan')->orderBy('nama_desa')->get();
        return view('admin.bumdes.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'nama_bumdes' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'status_hukum' => 'nullable|string|max:255',
            'klasifikasi' => 'nullable|string|max:255',
        ]);

        Bumdes::create($validated);

        return redirect()->route('admin.bumdes.index')->with('success', 'BUMDes berhasil ditambah.');
    }

    public function edit(Bumdes $bumdes)
    {
        $desas = Desa::with('kecamatan')->orderBy('nama_desa')->get();
        return view('admin.bumdes.edit', compact('bumdes', 'desas'));
    }

    public function update(Request $request, Bumdes $bumdes)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'nama_bumdes' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'status_hukum' => 'nullable|string|max:255',
            'klasifikasi' => 'nullable|string|max:255',
        ]);

        $bumdes->update($validated);

        return redirect()->route('admin.bumdes.index')->with('success', 'BUMDes berhasil diupdate.');
    }

    public function destroy(Bumdes $bumdes)
    {
        $bumdes->delete();
        return back()->with('success', 'BUMDes berhasil dihapus.');
    }
}

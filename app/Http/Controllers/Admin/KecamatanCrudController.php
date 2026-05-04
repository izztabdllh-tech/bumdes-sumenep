<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanCrudController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $data = Kecamatan::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_kecamatan', 'like', "%{$q}%");
            })
            ->orderBy('nama_kecamatan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kecamatan.index', compact('data', 'q'));
    }

    public function create()
    {
        return view('admin.kecamatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        Kecamatan::create($validated);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil ditambah.');
    }

    public function edit(Kecamatan $kecamatan)
    {
        return view('admin.kecamatan.edit', compact('kecamatan'));
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        $kecamatan->update($validated);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil diupdate.');
    }

    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return back()->with('success', 'Kecamatan berhasil dihapus.');
    }
}

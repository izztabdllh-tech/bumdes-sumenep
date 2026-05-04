<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Bumdes;
use Illuminate\Http\Request;

class ProdukCrudController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $data = Produk::with('bumdes.desa.kecamatan')
            ->when($q, function ($query) use ($q) {
                $query->where('nama_produk', 'like', "%{$q}%")
                      ->orWhere('kategori', 'like', "%{$q}%")
                      ->orWhere('jenis_usaha', 'like', "%{$q}%")
                      ->orWhere('tahun', 'like', "%{$q}%")
                      ->orWhereHas('bumdes', function ($q2) use ($q) {
                          $q2->where('nama_bumdes', 'like', "%{$q}%")
                             ->orWhereHas('desa', function ($q3) use ($q) {
                                 $q3->where('nama_desa', 'like', "%{$q}%")
                                    ->orWhereHas('kecamatan', function ($q4) use ($q) {
                                        $q4->where('nama_kecamatan', 'like', "%{$q}%");
                                    });
                             });
                      });
            })
            ->orderBy('nama_produk')
            ->paginate(10)
            ->withQueryString();

        return view('admin.produk.index', compact('data', 'q'));
    }

    public function create()
    {
        $bumdes = Bumdes::with('desa.kecamatan')->orderBy('nama_bumdes')->get();
        return view('admin.produk.create', compact('bumdes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bumdes_id' => 'required|exists:bumdes,id',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        Produk::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambah.');
    }

    public function edit(Produk $produk)
    {
        $bumdes = Bumdes::with('desa.kecamatan')->orderBy('nama_bumdes')->get();
        return view('admin.produk.edit', compact('produk', 'bumdes'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'bumdes_id' => 'required|exists:bumdes,id',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $produk->update($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}

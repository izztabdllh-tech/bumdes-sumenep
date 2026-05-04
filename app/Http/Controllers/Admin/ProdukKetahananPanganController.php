<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukKetahananPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukKetahananPanganController extends Controller
{
    public function index()
    {
        $items = ProdukKetahananPangan::latest()->get();
        return view('admin.produk.ketahanan-pangan.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $dir = public_path('produk/ketahanan-pangan');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $file = $request->file('gambar');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move($dir, $filename);

        ProdukKetahananPangan::create([
            'nama' => $request->nama,
            'gambar' => 'produk/ketahanan-pangan/'.$filename,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, ProdukKetahananPangan $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $produk->nama = $request->nama;

        if ($request->hasFile('gambar')) {
            $dir = public_path('produk/ketahanan-pangan');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            // hapus gambar lama
            if ($produk->gambar) {
                $oldPath = public_path($produk->gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('gambar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);

            $produk->gambar = 'produk/ketahanan-pangan/'.$filename;
        }

        $produk->save();

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(ProdukKetahananPangan $produk)
    {
        if ($produk->gambar) {
            $path = public_path($produk->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}

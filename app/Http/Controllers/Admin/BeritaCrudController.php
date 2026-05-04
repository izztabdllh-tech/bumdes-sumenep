<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaCrudController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('ringkasan', 'like', '%' . $request->search . '%')
                  ->orWhere('isi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status);
        }

        if ($request->filled('penulis')) {
            $query->where('penulis', $request->penulis);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $beritas = $query->latest()->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penulis' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'is_published' => 'required|boolean',
            'link_instagram' => 'nullable|url',
            'link_tiktok' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_youtube' => 'nullable|url',
        ]);

        $gambarName = null;

        if ($request->hasFile('gambar')) {
            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads'), $gambarName);
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'gambar' => $gambarName,
            'penulis' => $request->penulis,
            'tanggal' => $request->tanggal,
            'is_published' => $request->is_published,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
            'link_facebook' => $request->link_facebook,
            'link_youtube' => $request->link_youtube,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', [
            'berita' => $beritum
        ]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penulis' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'is_published' => 'required|boolean',
            'link_instagram' => 'nullable|url',
            'link_tiktok' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_youtube' => 'nullable|url',
        ]);

        $data = $request->only([
            'judul',
            'ringkasan',
            'isi',
            'penulis',
            'tanggal',
            'is_published',
            'link_instagram',
            'link_tiktok',
            'link_facebook',
            'link_youtube',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        $data['slug'] = Str::slug($request->judul) . '-' . time();

        $beritum->update($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        $beritum->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
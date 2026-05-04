<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesaCrudController extends Controller
{
    protected function logActivity($action, $module, $description)
    {
        DB::table('activity_logs')->insert([
            'username' => session('admin_username', 'Admin'),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function index(Request $request)
    {
        $q = $request->query('q');

        $data = Desa::with('kecamatan')
            ->when($q, function ($query) use ($q) {
                $query->where('nama_desa', 'like', "%{$q}%")
                      ->orWhereHas('kecamatan', function ($q2) use ($q) {
                          $q2->where('nama_kecamatan', 'like', "%{$q}%");
                      });
            })
            ->orderBy('nama_desa')
            ->paginate(10)
            ->withQueryString();

        return view('admin.desa.index', compact('data', 'q'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'nama_desa' => 'required|string|max:255',
        ]);

        $desa = Desa::create($validated);

        $this->logActivity(
            'CREATE',
            'Desa',
            'Menambahkan data desa: ' . $desa->nama_desa
        );

        return redirect()->route('admin.desa.index')->with('success', 'Desa berhasil ditambah.');
    }

    public function edit(Desa $desa)
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, Desa $desa)
    {
        $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'nama_desa' => 'required|string|max:255',
        ]);

        $namaLama = $desa->nama_desa;

        $desa->update($validated);

        $this->logActivity(
            'UPDATE',
            'Desa',
            'Mengubah data desa: ' . $namaLama . ' menjadi ' . $desa->nama_desa
        );

        return redirect()->route('admin.desa.index')->with('success', 'Desa berhasil diupdate.');
    }

    public function destroy(Desa $desa)
    {
        $namaDesa = $desa->nama_desa;

        $desa->delete();

        $this->logActivity(
            'DELETE',
            'Desa',
            'Menghapus data desa: ' . $namaDesa
        );

        return back()->with('success', 'Desa berhasil dihapus.');
    }
}
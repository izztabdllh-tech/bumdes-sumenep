<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;

class SaranAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $status = $request->status;

        $items = Saran::query()
            ->when($q, function($query) use ($q){
                $query->where('nama','like',"%$q%")
                      ->orWhere('kontak','like',"%$q%")
                      ->orWhere('kategori','like',"%$q%")
                      ->orWhere('pesan','like',"%$q%");
            })
            ->when($status, fn($query) => $query->where('status',$status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.saran.index', compact('items','q','status'));
    }

    public function show(Saran $saran)
    {
        return view('admin.saran.show', compact('saran'));
    }

    public function update(Request $request, Saran $saran)
    {
        $request->validate([
            'status' => 'required|in:Baru,Diproses,Selesai',
            'tanggapan' => 'nullable|string|max:5000',
        ]);

        $saran->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'ditanggapi_pada' => $request->tanggapan ? now() : $saran->ditanggapi_pada,
            'ditanggapi_oleh' => $request->tanggapan ? session('admin_username') : $saran->ditanggapi_oleh,
        ]);

        return back()->with('success', 'Saran berhasil diperbarui.');
    }

    public function destroy(Saran $saran)
    {
        $saran->delete();
        return redirect()->route('admin.saran.index')->with('success', 'Saran berhasil dihapus.');
    }
}

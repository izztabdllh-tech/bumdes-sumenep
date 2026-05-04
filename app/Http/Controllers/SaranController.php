<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;
use App\Models\User;
use App\Notifications\SaranBaruNotification;
use Illuminate\Support\Facades\Hash;

class SaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:120',
            'kontak' => 'nullable|string|max:120',
            'kategori' => 'required|string|max:50',
            'pesan' => 'required|string|max:2000',
        ]);

        $saran = Saran::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'kategori' => $request->kategori,
            'pesan' => $request->pesan,
            'status' => 'Baru',
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@bumdes.local'],
            [
                'name' => 'Bumdesa',
                'password' => Hash::make('bumdesa2026'),
            ]
        );

        $admin->notify(new SaranBaruNotification($saran));

        return back()->with('success', 'Terima kasih! Saran Anda berhasil dikirim.');
    }
}
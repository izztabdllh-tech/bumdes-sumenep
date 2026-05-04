<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Bumdes;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_username')) {
            return redirect()->route('admin.login');
        }

        $notifications = DB::table('notifications')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $unreadCount = DB::table('notifications')
            ->whereNull('read_at')
            ->count();

        $beritas = Berita::latest()->take(3)->get();

        return view('admin.dashboard', [
            'notifications'   => $notifications,
            'unreadCount'     => $unreadCount,
            'totalKecamatan'  => Kecamatan::count(),
            'totalDesa'       => Desa::count(),
            'totalBumdes'     => Bumdes::count(),
            'totalProduk'     => DB::table('produk_ketahanan_pangan')->count(),
            'beritas'         => $beritas,
        ]);
    }
}
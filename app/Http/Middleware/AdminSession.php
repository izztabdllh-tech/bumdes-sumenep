<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_username')) {
            return redirect()->route('admin.login');
        }

        session()->put('nama_bumdes', session('nama_bumdes', 'Admin'));
        session()->put('nama_kecamatan', session('nama_kecamatan', '-'));

        return $next($request);
    }
}

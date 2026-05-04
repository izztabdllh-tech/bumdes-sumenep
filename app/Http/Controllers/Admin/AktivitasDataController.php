<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AktivitasDataController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('activity_logs')->latest();

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->keyword . '%')
                  ->orWhere('module', 'like', '%' . $request->keyword . '%')
                  ->orWhere('action', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('admin.aktivitas-data', compact('logs'));
    }
}
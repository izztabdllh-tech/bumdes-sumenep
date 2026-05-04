<?php

namespace App\Http\Controllers;

use App\Models\Desa;

class DesaController extends Controller
{
    public function index()
{
    $desa = Desa::all();
    return view('desa.index', compact('desa'));
}

}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\BeritaController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KecamatanCrudController;
use App\Http\Controllers\Admin\DesaCrudController;
use App\Http\Controllers\Admin\BumdesCrudController;
use App\Http\Controllers\Admin\ProdukCrudController;
use App\Http\Controllers\Admin\ProdukKetahananPanganController;
use App\Http\Controllers\Admin\SaranAdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AktivitasDataController;
use App\Http\Controllers\Admin\BeritaCrudController;

Route::get('/', fn () => view('home'))->name('home');

Route::get('/saran', fn () => view('saran.index'))->name('saran.index');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
Route::get('/desa', [DesaController::class, 'index'])->name('desa.index');

Route::get('/bumdes', [BumdesController::class, 'index'])->name('bumdes.index');
Route::get('/bumdes/export/excel', [BumdesController::class, 'exportExcel'])->name('bumdes.export.excel');
Route::get('/bumdes/export/word', [BumdesController::class, 'exportWord'])->name('bumdes.export.word');

Route::get('/informasi', function () {
    $placeholder = asset('logo.png');

    $img = fn ($path) => asset($path);

    $tim1 = [
        ['nama' => 'TAUFIQURRAHMAN, SE', 'foto' => 'struktur/Taufiqurrahman.jpg'],
        ['nama' => 'R. ACHMAD MUZAMMIL F, S.Sos', 'foto' => 'struktur/Achmad Muzammil.jpg'],
        ['nama' => 'EDO PERDANA PS, ST', 'foto' => 'struktur/Edo Perdana.jpg'],
    ];

    $tim2 = [
        ['nama' => 'TAUFIQURRAHMAN, SE', 'foto' => 'struktur/Taufiqurrahman.jpg'],
        ['nama' => 'ACH. SABRINI FIRMANSYAH, SE', 'foto' => 'struktur/Ach Sabrini.jpg'],
        ['nama' => 'AGUS HARYANTO, SE', 'foto' => 'struktur/Agus Haryanto.jpg'],
    ];

    return view('informasi.index', compact('placeholder', 'img', 'tim1', 'tim2'));
})->name('informasi.index');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

Route::get('/digitalisasi', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/digitalisasi/ketahanan-pangan', [ProdukController::class, 'ketahananPangan'])->name('produk.ketahanan_pangan');
Route::get('/digitalisasi/unit-usaha', [ProdukController::class, 'unitUsaha'])->name('produk.unit_usaha');

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', fn () => view('admin.login'))->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string|max:50',
        'password' => 'required|string|min:6',
    ]);

    if ($request->username !== 'Bumdesa' || $request->password !== 'bumdesa2026') {
        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ])->withInput();
    }

    session([
        'admin_username' => $request->username,
        'is_admin_logged_in' => true,
    ]);

    return redirect()->route('admin.dashboard');
})->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', function () {
        session()->forget('admin_username');
        session()->forget('is_admin_logged_in');
        return redirect()->route('home');
    })->name('logout');

    // Semua route admin pakai middleware
    Route::middleware('admin.session')->group(function () {

        // CRUD utama
        Route::resource('kecamatan', KecamatanCrudController::class);
        Route::resource('desa', DesaCrudController::class);
        Route::resource('bumdes', BumdesCrudController::class);
        Route::resource('produk', ProdukCrudController::class);

        // ✅ BERITA (INI YANG KAMU BUTUHKAN)
        Route::resource('berita', BeritaCrudController::class);

        // Ketahanan Pangan
        Route::get('/ketahanan-pangan', [ProdukKetahananPanganController::class, 'index'])->name('kp.index');
        Route::post('/ketahanan-pangan', [ProdukKetahananPanganController::class, 'store'])->name('kp.store');
        Route::put('/ketahanan-pangan/{produk}', [ProdukKetahananPanganController::class, 'update'])->name('kp.update');
        Route::delete('/ketahanan-pangan/{produk}', [ProdukKetahananPanganController::class, 'destroy'])->name('kp.destroy');

        // Saran
        Route::get('/saran', [SaranAdminController::class, 'index'])->name('saran.index');
        Route::get('/saran/{saran}', [SaranAdminController::class, 'show'])->name('saran.show');
        Route::put('/saran/{saran}', [SaranAdminController::class, 'update'])->name('saran.update');
        Route::delete('/saran/{saran}', [SaranAdminController::class, 'destroy'])->name('saran.destroy');

        // Notifikasi
        Route::get('/notifications/go-to-saran', function () {
            DB::table('notifications')
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return redirect()->route('admin.saran.index');
        })->name('notifications.goToSaran');

        // Aktivitas
        Route::get('/aktivitas-data', [AktivitasDataController::class, 'index'])->name('aktivitas.index');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/profile/password', [ProfileController::class, 'passwordForm'])->name('profile.password');
        Route::post('/profile/password', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    });
});
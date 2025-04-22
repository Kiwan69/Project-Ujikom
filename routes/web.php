<?php

use App\Http\Controllers\StadionController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Models\Acara;
use App\Models\Stadion;
use App\Models\Tiket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('backend.admin');
// });

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('backend.admin');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('home.user');
});

Route::get('/', function () {
    $stadion = Stadion::all();
    return view('frontend.home', compact('stadion'));
})->name('home.user');

Route::get('/match', function () {
    $acara = Acara::all();
    return view('frontend.acara', compact('acara'));
})->name('acara');

Route::get('/tiket', [TiketController::class, 'tampilkanTiket'])->name('tiket');
Route::get('/tiket/{id}/beli', [TiketController::class, 'beli'])->name('tiket.beli');
Route::post('/tiket/konfirmasi', [TiketController::class, 'konfirmasi'])->name('tiket.konfirmasi');


// // ✅ Route tambahan untuk menampilkan tiket berdasarkan kategori
// Route::get('/tiket/{kategori}', [TiketController::class, 'kategori'])->name('tiket.kategori');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('layouts.backend.admin');
        // Route::get('/admin/pemesanan', [\App\Http\Controllers\AdminPemesananController::class, 'index'])->name('admin.pemesanan');
    });
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::resource('stadion', StadionController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('acara', AcaraController::class);
    Route::resource('tiket', TiketController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('pembayaran', PembayaranController::class);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanRuanganController;
use App\Http\Controllers\AdminController;

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

// Route::get('/admin', function () {
//     return view('admin.setup');
// });
Route::get('/admin', [AdminController::class, 'index']);

// tidak usah dipakai
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('/admin/validasi', function () {
    return view('admin.validasi');
});

Route::get('/admin/detail_validasi', function () {
    return view('admin.validasidetail');
});

Route::post('/validasiPeminjaman/{id}', [PeminjamanRuanganController::class, 'validasiPeminjaman'])->name('validasiPeminjaman');

Route::get('/peminjaman-ruangan', 'PeminjamanRuanganController@index')->name('peminjaman.ruangan.index');

Route::post('/admin/tolak/{id}', [PeminjamanRuanganController::class, 'tolakPeminjaman'])->name('tolakPeminjaman');

Route::post('/admin/hapus/{id}', [PeminjamanRuanganController::class, 'hapusPeminjaman'])->name('hapusPeminjaman');



Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/validate', [AuthController::class, 'login'])->name('login.valid');
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register/valid', [AuthController::class, 'register'])->name('register.valid');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('user.home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/cek', [HomeController::class, 'cek'])->name('user.cek');
    Route::get('/ruang', [HomeController::class, 'ruang'])->name('user.ruang');
    Route::get('/kontak', [HomeController::class, 'kontak'])->name('user.kontak');

    Route::post('/batal', [HomeController::class, 'batal'])->name('user.batal');

    Route::post('/pinjam', [HomeController::class, 'pinjam'])->name('pinjam');

});
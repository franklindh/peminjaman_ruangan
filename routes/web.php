<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/admin', function () {
    return view('admin.setup');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/validate', [AuthController::class, 'login'])->name('login.valid');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('user.home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ruang', [HomeController::class, 'ruang'])->name('user.ruang');
    Route::get('/kontak', [HomeController::class, 'kontak'])->name('user.kontak');

    Route::post('/pinjam', [HomeController::class, 'pinjam'])->name('pinjam');
});
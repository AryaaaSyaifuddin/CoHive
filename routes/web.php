<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Middleware\HarusLogoutMiddleware;
use App\Http\Middleware\LoginMiddleware;

// Grup route yang membutuhkan login
Route::middleware([LoginMiddleware::class])->group(function () {
    Route::get("/", [RouteController::class, "dashboard"]);


    Route::get("/profile", [RouteController::class, "profile"]);
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    Route::get("/anggota", [RouteController::class, "anggota"]);
    Route::put('/anggota/{user}', [AnggotaController::class, 'update'])->name('anggota.update');


    Route::get("/stok-barang", [RouteController::class, "stokBarang"]);
    Route::post('/barangs', [BarangController::class, 'store'])->name('barangs.store');
    Route::post('/barang/keluar', [BarangController::class, 'keluar'])->name('barang.keluar');
    Route::get('/barangs/detail/{id}', [BarangController::class, 'detail'])->name('produk.detail');
    Route::put('/barangs/{id}', [BarangController::class, 'update'])->name('barangs.update');


    Route::get("/keuangan", [RouteController::class, "keuangan"]);


    // Jadwal anggota dapat ditampilkan oleh EventController (jika diperlukan)
    Route::get("/jadwal_anggota", [RouteController::class, 'jadwal_anggota'])->name('jadwal');
    Route::get('/events', [EventController::class, 'getEvents'])->middleware('auth');
    Route::post('/events', [EventController::class, 'store'])->middleware('auth');


    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    })->name('logout');

});

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Grup route untuk halaman login/register ketika pengguna sudah logout (misal menggunakan middleware custom)
Route::middleware([HarusLogoutMiddleware::class])->group(function () {
    Route::get("/login", [RouteController::class, "loginRegister"]);
    Route::post('/loginCheck', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/homepage', [RouteController::class, 'homepage']);

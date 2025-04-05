<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HarusLogoutMiddleware;
use App\Http\Middleware\LoginMiddleware;

use Illuminate\Support\Facades\Route;


Route::middleware([LoginMiddleware::class])->group(function () {
    Route::get("/", [RouteController::class, "dashboard"]);


    Route::get("/profile", [RouteController::class, "profile"]);
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get("/anggota", [RouteController::class, "anggota"]);


    Route::get("/stok-barang", [RouteController::class, "stokBarang"]);


    Route::get("/keuangan", [RouteController::class, "keuangan"]);


    Route::get("/jadwal_anggota", [RouteController::class, "jadwal_anggota"]);


    Route::get('/logout', function () {Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    })->name('logout');
});



Route::middleware([HarusLogoutMiddleware::class])->group(function () {
    Route::get("/login", [RouteController::class, "loginRegister"]);
    Route::post('/loginCheck', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


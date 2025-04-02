<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;





Route::get("/", [RouteController::class, "dashboard"]);
Route::get("/profile", [RouteController::class, "profile"]);
Route::get("/anggota", [RouteController::class, "anggota"]);
Route::get("/stok-barang", [RouteController::class, "stokBarang"]);
Route::get("/keuangan", [RouteController::class, "keuangan"]);
Route::get("/jadwal_anggota", [RouteController::class, "jadwal_anggota"]);


Route::get("/login", [RouteController::class, "loginRegister"]);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

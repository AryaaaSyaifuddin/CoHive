<?php

use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;





Route::get("/", [RouteController::class, "dashboard"]);
Route::get("/profile", [RouteController::class, "profile"]);
Route::get("/anggota", [RouteController::class, "anggota"]);
Route::get("/stok-barang", [RouteController::class, "stokBarang"]);
Route::get("/keuangan", [RouteController::class, "keuangan"]);
Route::get("/laporan", [RouteController::class, "laporan"]);


Route::get("/login", [RouteController::class, "loginRegister"]);

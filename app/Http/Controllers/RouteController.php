<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function dashboard(){
        return view("dashboard");
    }

    public function profile(){
        $user = Auth::user();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        return view('profile', compact('user', 'profile'));
    }

    public function anggota(){
        return view("anggota");
    }

    public function stokBarang(){
        $barangs = Barang::all();
        return view("stok-barang", compact('barangs'));
    }

    public function keuangan(){
        return view("keuangan");
    }

    public function jadwal_anggota(){
        return view("jadwal_anggota");
    }

    public function loginRegister(){
        return view("login_register_form");
    }
}

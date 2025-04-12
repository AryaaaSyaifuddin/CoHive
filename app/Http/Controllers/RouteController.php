<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function dashboard(){$users = Auth::user();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);


        return view('dashboard', compact('users', 'profile'));
    }

    public function profile(){
        $users = Auth::user();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);


        return view('profile', compact('users', 'profile'));
    }

    public function anggota(){
        $users = Auth::user();
        $userData = User::with('profile')->get();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);


        return view('anggota', compact('users', 'profile', 'userData'));
    }

    public function stokBarang() {
        $users = Auth::user();
        // Cari data profile, jika belum ada, buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);

        $barangs = Barang::all();

        return view("stok-barang", compact('barangs', 'users', 'profile'));
    }


    public function keuangan(){
        $users = Auth::user();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);


        return view('keuangan', compact('users', 'profile'));
    }

    public function jadwal_anggota(){
        $users = Auth::user();
        // Cari data profile, jika belum ada buat instance baru
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);


        return view('jadwal_anggota', compact('users', 'profile'));
    }

    public function loginRegister(){
        return view("login_register_form");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard(){
        return view("dashboard");
    }

    public function profile(){
        return view("profile");
    }

    public function anggota(){
        return view("anggota");
    }

    public function stokBarang(){
        return view("stok-barang");
    }

    public function keuangan(){
        return view("keuangan");
    }

    public function laporan(){
        return view("laporan");
    }

    public function loginRegister(){
        return view("login_register_form");
    }
}

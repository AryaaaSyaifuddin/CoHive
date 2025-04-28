<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{

    public function homepage(){
        return view('homepage');
    }

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
        $profile = $users->profile ?? (new Profile)->fill(['user_id' => $users->id]);

        $barangs = Barang::all();

        // Gabungan barang masuk
        $barangMasuk = DB::table('barang_masuks')
            ->join('barangs', 'barang_masuks.barang_id', '=', 'barangs.id')
            ->join('users', 'barang_masuks.user_id', '=', 'users.id')
            ->select(
                'barang_masuks.id',
                'barangs.id_barang',
                'barangs.nama_barang',
                'barangs.varian',
                'barangs.harga_beli',
                'barangs.harga_jual',
                'barangs.tanggal_exp',
                'barang_masuks.user_id',
                'users.username',
                'barang_masuks.jumlah',
                'barang_masuks.tanggal',
                'barang_masuks.created_at',
                DB::raw("'masuk' as tipe")
            );

        // Gabungan barang keluar
        $barangKeluar = DB::table('barang_keluars')
            ->join('barangs', 'barang_keluars.barang_id', '=', 'barangs.id')
            ->join('users', 'barang_keluars.user_id', '=', 'users.id')
            ->select(
                'barang_keluars.id',
                'barangs.id_barang',
                'barangs.nama_barang',
                'barangs.varian',
                'barangs.harga_beli',
                'barangs.harga_jual',
                'barangs.tanggal_exp',
                'barang_keluars.user_id',
                'users.username',
                'barang_keluars.jumlah',
                'barang_keluars.tanggal',
                'barang_keluars.created_at',
                DB::raw("'keluar' as tipe")
            );

        $unionQuery = $barangMasuk->unionAll($barangKeluar);

        $aktifitas = DB::table(DB::raw("({$unionQuery->toSql()}) as union_aktifitas"))
            ->mergeBindings($unionQuery)
            ->orderBy('created_at', 'desc')
            ->get();

        $existingProducts = Barang::select('id_barang', 'nama_barang', 'varian')
            ->distinct()
            ->get();

        $sevenDaysAgo = \Carbon\Carbon::now()->subDays(7);

        $jumlahKategori = Barang::distinct('varian')->count('varian');

        $totalBarangMasuk = DB::table('barang_masuks')
            ->where('tanggal', '>=', $sevenDaysAgo)
            ->sum('jumlah');

        $nilaiTotalMasuk = DB::table('barang_masuks')
            ->join('barangs', 'barang_masuks.barang_id', '=', 'barangs.id')
            ->where('barang_masuks.tanggal', '>=', $sevenDaysAgo)
            ->sum(DB::raw('barang_masuks.jumlah * barangs.harga_beli'));

        $totalBarangKeluar = DB::table('barang_keluars')
            ->where('tanggal', '>=', $sevenDaysAgo)
            ->sum('jumlah');

        $nilaiTotalKeluar = DB::table('barang_keluars')
            ->join('barangs', 'barang_keluars.barang_id', '=', 'barangs.id')
            ->where('barang_keluars.tanggal', '>=', $sevenDaysAgo)
            ->sum(DB::raw('barang_keluars.jumlah * barangs.harga_jual'));

        $totalStokDipesan = Barang::where('stok', '<', 5)->count();
        $stokTersedia = Barang::sum('stok');

        return view("stok-barang", compact(
            'barangs',
            'users',
            'profile',
            'aktifitas',
            'existingProducts',
            'jumlahKategori',
            'totalBarangMasuk',
            'nilaiTotalMasuk',
            'totalBarangKeluar',
            'nilaiTotalKeluar',
            'totalStokDipesan',
            'stokTersedia'
        ));
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

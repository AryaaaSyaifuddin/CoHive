<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required|string|max:255',
            'varian' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|date',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'tanggal_exp' => 'nullable|date|after_or_equal:tanggal_masuk',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_produk', 'public');
        }

        // Simpan ke tabel barangs
        $barang = Barang::create([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'varian' => $request->varian,
            'stok' => $request->stok,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'tanggal_exp' => $request->tanggal_exp,
            'gambar' => $gambarPath,
            'tanggal' => $request->tanggal_masuk, // ini opsional, kalau memang ada field tanggal di tabel barangs
        ]);

        // Simpan ke tabel barang_masuks
        BarangMasuk::create([
            'barang_id' => $barang->id,
            'user_id' => Auth::id(),
            'jumlah' => $request->stok,
            'tanggal' => $request->tanggal_masuk,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }



    public function detail($id)
    {
        $barang = Barang::findOrFail($id);
        return view('stok-barang', compact('barang'));
    }

    public function keluar(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'tanggal_exp' => 'required|date',
            'jumlah_keluar' => 'required|integer|min:1',
        ]);

        // Cari barang berdasarkan kombinasi id_barang dan tanggal_exp
        $barang = Barang::where('id_barang', $request->id_barang)
                        ->where('tanggal_exp', $request->tanggal_exp)
                        ->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan dengan tanggal kadaluarsa tersebut.');
        }

        if ($barang->stok < $request->jumlah_keluar) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok
        $barang->stok -= $request->jumlah_keluar;
        $barang->save();

        // Simpan ke tabel barang_keluars
        BarangKeluar::create([
            'barang_id' => $barang->id,
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah_keluar,
            'tanggal' => now()->toDateString(),
        ]);

        return back()->with('success', 'Barang berhasil dikeluarkan dan dicatat di riwayat!');
    }


    public function update(Request $request, $id)
    {
        // Validasi sesuai kebutuhan (sesuaikan dengan aturan validasi yang digunakan pada tambah barang)
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required|string|max:255',
            'varian' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|date',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'tanggal_exp' => 'nullable|date|after_or_equal:tanggal_masuk',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari data barang berdasarkan id
        $barang = Barang::findOrFail($id);

        // Jika ada gambar baru diunggah, simpan dan update
        if($request->hasFile('gambar')){
            $gambarPath = $request->file('gambar')->store('gambar_produk', 'public');
            $barang->gambar = $gambarPath;
        }

        // Update data barang
        $barang->update([
            'id_barang'    => $request->id_barang,
            'nama_barang'  => $request->nama_barang,
            'varian'       => $request->varian,
            'stok'         => $request->stok,
            'tanggal_masuk'=> $request->tanggal_masuk,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
            'tanggal_exp'  => $request->tanggal_exp,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }


}

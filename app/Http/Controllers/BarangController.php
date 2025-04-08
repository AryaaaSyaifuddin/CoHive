<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|unique:barangs,id_barang',
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:100',
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

        Barang::create([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'stok' => $request->stok,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'tanggal_exp' => $request->tanggal_exp,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $barang = Barang::findOrFail($id);
        return view('stok-barang', compact('barang'));
    }
}

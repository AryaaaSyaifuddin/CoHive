<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    // Field yang bisa diisi secara massal
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'jenis_barang',
        'stok',
        'tanggal_masuk',
        'harga_beli',
        'harga_jual',
        'tanggal_exp',
        'gambar',
    ];
}

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
        'varian',
        'stok',
        'tanggal_masuk',
        'harga_beli',
        'harga_jual',
        'tanggal_exp',
        'gambar',
    ];

    // app/Models/Barang.php

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }

}

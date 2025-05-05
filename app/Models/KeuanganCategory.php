<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganCategory extends Model
{
    protected $table = 'keuangan_categories';

    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(KeuanganTransaction::class, 'category_id');
    }
}

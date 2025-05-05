<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganTransaction extends Model
{
    protected $table = 'keuangan_transactions';

    protected $fillable = [
        'user_id',
        'account_id',
        'category_id',
        'amount',
        'transaction_date',
        'description',
    ];

     // relasi ke user
     public function user()
     {
       return $this->belongsTo(\App\Models\User::class, 'user_id');
     }

     // relasi ke account
     public function account()
     {
       return $this->belongsTo(\App\Models\KeuanganAccount::class, 'account_id');
     }

     // relasi ke category
     public function category()
     {
       return $this->belongsTo(\App\Models\KeuanganCategory::class, 'category_id');
     }
}

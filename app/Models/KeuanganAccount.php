<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class keuanganAccount extends Model
{
    protected $table = 'keuangan_accounts';

    protected $fillable = [
        'user_id',
        'name',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function transactions()
    {
    return $this->hasMany(\App\Models\KeuanganTransaction::class, 'account_id');
    }
}

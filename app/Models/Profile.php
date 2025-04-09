<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name' , 'birth_date', 'gender', 'phone', 'address', 'photo'
    ];

    /**
     * Relasi ke model User (satu profile untuk satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

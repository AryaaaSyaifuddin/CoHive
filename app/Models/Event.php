<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory; // jika Anda menggunakan factory

    protected $fillable = [
        'title', 'date', 'start_time', 'end_time', 'visibility', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

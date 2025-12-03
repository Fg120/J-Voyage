<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $fillable = [
        'user_id',
        'pengelola_id',
        'ulasan',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class, 'pengelola_id');
    }
}

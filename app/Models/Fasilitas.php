<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas'; // Explicitly set table name since plural of fasilitas is fasilitas

    protected $fillable = ['pengelola_id', 'nama'];

    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class);
    }
}

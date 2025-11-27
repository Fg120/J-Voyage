<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = ['pengelola_id', 'nama'];

    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'pengelola_id',
        'user_id',
        'kode',
        'nama',
        'email',
        'telepon',
        'tanggal_kunjungan',
        'jumlah',
        'catatan',
        'harga_satuan',
        'total_harga',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
        'scanned_at',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'scanned_at' => 'datetime',
    ];

    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

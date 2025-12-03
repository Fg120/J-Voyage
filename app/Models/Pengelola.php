<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelola extends Model
{
    use HasFactory;

    protected $table = 'pengelola';

    protected $fillable = [
        'user_id',
        'nama_wisata',
        'kecamatan_id',
        'desa_id',
        'alamat_wisata',
        'deskripsi_wisata',
        'foto_wisata',
        'kontak_wisata',
        'jam_buka',
        'jam_tutup',
        'file_izin',
        'file_ktp',
        'file_npwp',
        'alasan_pengajuan',
        'catatan_admin',
        'status',
        'verified_at',
        'harga',
        'nomor_rekening',
        'nama_bank',
        'nama_pemilik_rekening',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function highlights()
    {
        return $this->hasMany(Highlight::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'approved' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>',
            'rejected' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>',
            'blocked' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Diblokir</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Unknown</span>',
        };
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
}

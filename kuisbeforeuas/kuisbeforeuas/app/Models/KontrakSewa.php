<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
    protected $table = 'kontrak_sewa';
    
    protected $fillable = [
        'penyewa_id',
        'kamar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga_bulanan',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}

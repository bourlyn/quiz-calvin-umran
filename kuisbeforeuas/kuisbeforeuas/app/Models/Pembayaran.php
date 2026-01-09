<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'kontrak_sewa_id',
        'bulan',
        'tahun',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
        'keterangan',
        'bukti_transfer',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function kontrakSewa()
    {
        return $this->belongsTo(KontrakSewa::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    
    protected $fillable = [
        'nomor_kamar',
        'tipe',
        'harga_bulanan',
        'fasilitas',
        'status',
    ];

    public function kontrakAktif()
    {
        return $this->hasOne(KontrakSewa::class)->where('status', 'aktif');
    }

    public function semuaKontrak()
    {
        return $this->hasMany(KontrakSewa::class);
    }
}

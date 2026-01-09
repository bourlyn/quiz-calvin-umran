<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'nomor_ktp',
        'alamat_asal',
        'pekerjaan',
    ];

    public function kontrak()
    {
        return $this->hasMany(KontrakSewa::class);
    }
}

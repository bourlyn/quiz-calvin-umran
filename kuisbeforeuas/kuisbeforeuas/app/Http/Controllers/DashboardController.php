<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $totalPenyewa = Penyewa::count();
        
        $pendapatanBulanIni = Pembayaran::where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah_bayar');
            
        $pembayaranTertunggak = Pembayaran::where('status', 'tertunggak')->count();

        return view('dashboard', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'totalPenyewa',
            'pendapatanBulanIni',
            'pembayaranTertunggak'
        ));
    }
}

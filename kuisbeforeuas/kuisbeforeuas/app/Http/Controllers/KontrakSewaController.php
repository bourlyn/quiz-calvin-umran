<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontrakSewa;
use App\Models\Kamar;
use App\Models\Penyewa;

class KontrakSewaController extends Controller
{

    public function index()
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar'])->latest()->get();
        return view('kontrak.index', compact('kontrak'));
    }


    public function create()
    {
        $penyewa = Penyewa::all();
        $kamar = Kamar::where('status', 'tersedia')->get();
        return view('kontrak.create', compact('penyewa', 'kamar'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
        ]);

        // Cek lagi apakah kamar tersedia (untuk mencegah race condition sederhana)
        $kamar = Kamar::findOrFail($request->kamar_id);
        if ($kamar->status !== 'tersedia') {
            return back()->with('error', 'Kamar sudah tidak tersedia.');
        }

        $validated['status'] = 'aktif';
        
        KontrakSewa::create($validated);
        
        // Update status kamar jadi terisi
        $kamar->update(['status' => 'terisi']);

        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak sewa berhasil dibuat.');
    }


    public function show(string $id)
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayaran'])->findOrFail($id);
        return view('kontrak.show', compact('kontrak'));
    }


    public function edit(string $id)
    {
        // Biasanya kontrak tidak diedit total, tapi mungkin tanggal selesai atau harga
        $kontrak = KontrakSewa::findOrFail($id);
        return view('kontrak.edit', compact('kontrak'));
    }


    public function update(Request $request, string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        $validated = $request->validate([
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai',
        ]);

        $statusLama = $kontrak->status;
        $kontrak->update($validated);

        // Jika status berubah jadi selesai, update kamar jadi tersedia
        if ($statusLama === 'aktif' && $validated['status'] === 'selesai') {
             $kontrak->kamar()->update(['status' => 'tersedia']);
        }
        // Jika status diubah kembali jadi aktif (misal salah edit), update kamar jadi terisi
        elseif ($statusLama === 'selesai' && $validated['status'] === 'aktif') {
             $kontrak->kamar()->update(['status' => 'terisi']);
        }

        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        // Jika kontrak aktif dihapus, kamar jadi tersedia
        if ($kontrak->status === 'aktif') {
            $kontrak->kamar()->update(['status' => 'tersedia']);
        }

        $kontrak->delete();

        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak berhasil dihapus.');
    }
}

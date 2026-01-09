<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;

class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaran = Pembayaran::with('kontrakSewa.penyewa')->latest()->get();
        return view('pembayaran.index', compact('pembayaran'));
    }


    public function create()
    {
        // Hanya kontrak aktif yang bisa bayar
        $kontrak = KontrakSewa::where('status', 'aktif')->with(['penyewa', 'kamar'])->get();
        return view('pembayaran.create', compact('kontrak'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
        ]);
        
        // Jika ada upload bukti transfer (Bonus)
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $validated['bukti_transfer'] = $path;
        }

        Pembayaran::create($validated);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat.');
    }


    public function show(string $id)
    {
        $pembayaran = Pembayaran::with('kontrakSewa.penyewa')->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }


    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }


    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:lunas,tertunggak',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        return redirect()->route('pembayaran.index')->with('success', 'Status pembayaran diperbarui.');
    }


    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran dihapus.');
    }
}

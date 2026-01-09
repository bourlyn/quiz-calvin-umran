<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewa;

class PenyewaController extends Controller
{

    public function index(Request $request)
    {
        $query = Penyewa::query();

        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_ktp', 'like', "%{$search}%")
                  ->orWhere('nomor_telepon', 'like', "%{$search}%");
            });
        }

        $penyewa = $query->get();
        return view('penyewa.index', compact('penyewa'));
    }


    public function create()
    {
        return view('penyewa.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:20|unique:penyewa',
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ]);

        Penyewa::create($validated);

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $penyewa = Penyewa::with('kontrak.kamar')->findOrFail($id);
        return view('penyewa.show', compact('penyewa'));
    }


    public function edit(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('penyewa.edit', compact('penyewa'));
    }


    public function update(Request $request, string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:20|unique:penyewa,nomor_ktp,' . $penyewa->id,
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ]);

        $penyewa->update($validated);

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        // Cek apakah ada kontrak aktif
        if ($penyewa->kontrak()->where('status', 'aktif')->exists()) {
            return back()->with('error', 'Penyewa masih memiliki kontrak aktif.');
        }

        $penyewa->delete();

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{

    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        if ($request->has('q') && $request->q != '') {
            $query->where('nomor_kamar', 'like', '%' . $request->q . '%');
        }

        $kamar = $query->get();
        return view('kamar.index', compact('kamar'));
    }


    public function create()
    {
        return view('kamar.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|unique:kamar|max:10',
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
        ]);

        Kamar::create($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $kamar = Kamar::with('kontrakAktif.penyewa')->findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }


    public function edit(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }


    public function update(Request $request, string $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        $validated = $request->validate([
            'nomor_kamar' => 'required|max:10|unique:kamar,nomor_kamar,' . $kamar->id,
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        if ($kamar->status === 'terisi') {
            return back()->with('error', 'Kamar sedang terisi, tidak dapat dihapus.');
        }
        
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}

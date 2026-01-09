@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kontrak-sewa.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Kontrak Sewa</h1>

    <div class="bg-gray-50 p-4 rounded-md mb-6">
        <p class="text-sm text-gray-700"><strong>Kamar:</strong> {{ $kontrak->kamar->nomor_kamar }}</p>
        <p class="text-sm text-gray-700"><strong>Penyewa:</strong> {{ $kontrak->penyewa->nama_lengkap }}</p>
        <p class="text-sm text-gray-700"><strong>Tanggal Mulai:</strong> {{ $kontrak->tanggal_mulai->format('d M Y') }}</p>
    </div>

    <form action="{{ route('kontrak-sewa.update', $kontrak->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
             <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
             <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $kontrak->tanggal_selesai->format('Y-m-d')) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
             @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700">Harga Sewa Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" id="harga_bulanan" value="{{ old('harga_bulanan', $kontrak->harga_bulanan) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('harga_bulanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Status Kontrak</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="aktif" {{ $kontrak->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="selesai" {{ $kontrak->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">Mengubah status ke "Selesai" akan mengupdate kamar menjadi "Tersedia".</p>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update Kontrak</button>
        </div>
    </form>
</div>
@endsection

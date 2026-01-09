@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kamar.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Kamar</h1>

    <form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nomor_kamar" class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" id="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('nomor_kamar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe</label>
            <select name="tipe" id="tipe" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="standard" {{ $kamar->tipe == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ $kamar->tipe == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
            </select>
            @error('tipe') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700">Harga Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" id="harga_bulanan" value="{{ old('harga_bulanan', $kamar->harga_bulanan) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('harga_bulanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
            <textarea name="fasilitas" id="fasilitas" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
            @error('fasilitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">Status otomatis berubah jadi "Terisi" jika ada kontrak aktif.</p>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection

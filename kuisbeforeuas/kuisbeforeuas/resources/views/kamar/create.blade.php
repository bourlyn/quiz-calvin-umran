@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kamar.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Kamar Baru</h1>

    <form action="{{ route('kamar.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="nomor_kamar" class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" id="nomor_kamar" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required placeholder="Contoh: A1">
            @error('nomor_kamar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe</label>
            <select name="tipe" id="tipe" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="standard">Standard</option>
                <option value="deluxe">Deluxe</option>
            </select>
            @error('tipe') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700">Harga Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" id="harga_bulanan" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required placeholder="Contoh: 1000000">
            @error('harga_bulanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
            <textarea name="fasilitas" id="fasilitas" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required placeholder="Contoh: Kasur, Lemari, WiFi"></textarea>
            @error('fasilitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection

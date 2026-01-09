@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('penyewa.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Data Penyewa</h1>

    <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $penyewa->nama_lengkap) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="nomor_ktp" class="block text-sm font-medium text-gray-700">Nomor KTP</label>
            <input type="text" name="nomor_ktp" id="nomor_ktp" value="{{ old('nomor_ktp', $penyewa->nomor_ktp) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('nomor_ktp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $penyewa->nomor_telepon) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('nomor_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $penyewa->pekerjaan) }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('pekerjaan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="alamat_asal" class="block text-sm font-medium text-gray-700">Alamat Asal (Sesuai KTP)</label>
            <textarea name="alamat_asal" id="alamat_asal" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>{{ old('alamat_asal', $penyewa->alamat_asal) }}</textarea>
            @error('alamat_asal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection

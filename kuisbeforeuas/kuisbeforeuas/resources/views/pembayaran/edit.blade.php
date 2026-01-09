@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('pembayaran.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Pembayaran</h1>

    <div class="bg-gray-50 p-4 rounded-md mb-6">
        <p class="text-sm text-gray-700"><strong>Penyewa:</strong> {{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</p>
        <p class="text-sm text-gray-700"><strong>Kamar:</strong> {{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</p>
        <p class="text-sm text-gray-700"><strong>Periode:</strong> {{ $pembayaran->bulan }} / {{ $pembayaran->tahun }}</p>
        <p class="text-sm text-gray-700"><strong>Jumlah:</strong> Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
    </div>

    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="tertunggak" {{ $pembayaran->status == 'tertunggak' ? 'selected' : '' }}>Tertunggak</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
             @error('keterangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update Status</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('pembayaran.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <div class="border-b border-gray-200 pb-4 mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Detail Pembayaran</h1>
        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $pembayaran->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ ucfirst($pembayaran->status) }}
        </span>
    </div>

    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Tanggal Bayar</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $pembayaran->tanggal_bayar->format('d F Y') }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Jumlah</dt>
            <dd class="mt-1 text-lg font-bold text-gray-900">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</dd>
        </div>

        <div class="sm:col-span-1">
             <dt class="text-sm font-medium text-gray-500">Penyewa</dt>
             <dd class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</dd>
        </div>
        <div class="sm:col-span-1">
             <dt class="text-sm font-medium text-gray-500">Kamar</dt>
             <dd class="mt-1 text-sm text-gray-900">{{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</dd>
        </div>

        <div class="sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
             <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
             <dd class="mt-1 text-sm text-gray-900">{{ $pembayaran->keterangan ?? '-' }}</dd>
        </div>
        
        @if($pembayaran->bukti_transfer)
        <div class="sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
             <dt class="text-sm font-medium text-gray-500 mb-2">Bukti Transfer</dt>
             <dd class="mt-1">
                 <img src="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" alt="Bukti Transfer" class="max-w-full h-auto rounded-md shadow-sm border border-gray-200" style="max-height: 400px;">
             </dd>
        </div>
        @endif
    </dl>
</div>
@endsection

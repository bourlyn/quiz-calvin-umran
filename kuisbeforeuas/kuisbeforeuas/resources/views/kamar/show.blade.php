@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kamar.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Detail Kamar {{ $kamar->nomor_kamar }}</h1>
     
        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Tipe</dt>
                <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $kamar->tipe }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Harga per Bulan</dt>
                <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1">
                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kamar->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($kamar->status) }}
                    </span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Fasilitas</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $kamar->fasilitas }}</dd>
            </div>
        </dl>
    </div>

    @if($kamar->kontrakAktif)
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Penyewa Saat Ini</h2>
        <div class="border-t border-gray-200 py-4">
             <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                 <div class="sm:col-span-2">
                     <dt class="text-sm font-medium text-gray-500">Nama</dt>
                     <dd class="mt-1 text-sm font-bold text-gray-900">{{ $kamar->kontrakAktif->penyewa->nama_lengkap }}</dd>
                 </div>
                 <div class="sm:col-span-1">
                     <dt class="text-sm font-medium text-gray-500">Mulai Sewa</dt>
                     <dd class="mt-1 text-sm text-gray-900">{{ $kamar->kontrakAktif->tanggal_mulai->format('d M Y') }}</dd>
                 </div>
                  <div class="sm:col-span-1">
                     <dt class="text-sm font-medium text-gray-900">Selesai Sewa</dt>
                     <dd class="mt-1 text-sm text-gray-900">{{ $kamar->kontrakAktif->tanggal_selesai->format('d M Y') }}</dd>
                 </div>
             </dl>
             <div class="mt-6">
                 <a href="{{ route('kontrak-sewa.show', $kamar->kontrakAktif->id) }}" class="text-green-600 hover:text-green-900 text-sm font-medium">Lihat Detail Kontrak &rarr;</a>
             </div>
        </div>
    </div>
    @endif
</div>
@endsection

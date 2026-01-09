@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kontrak-sewa.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Detail Kontrak Sewa</h1>
        
        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Nomor Kamar</dt>
                <dd class="mt-1 text-lg font-bold text-gray-900">{{ $kontrak->kamar->nomor_kamar }} ({{ ucfirst($kontrak->kamar->tipe) }})</dd>
            </div>
             <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Nama Penyewa</dt>
                <dd class="mt-1 text-lg font-bold text-gray-900">
                    <a href="{{ route('penyewa.show', $kontrak->penyewa->id) }}" class="text-green-600 hover:underline">{{ $kontrak->penyewa->nama_lengkap }}</a>
                </dd>
            </div>
             <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $kontrak->tanggal_mulai->format('d F Y') }}</dd>
            </div>
             <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Tanggal Selesai</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $kontrak->tanggal_selesai->format('d F Y') }}</dd>
            </div>
             <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Harga per Bulan</dt>
                <dd class="mt-1 text-sm font-bold text-gray-900">Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }}</dd>
            </div>
             <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kontrak->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($kontrak->status) }}
                    </span>
                </dd>
            </div>
        </dl>
    </div>

    <div class="md:col-span-3 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
             <h2 class="text-lg font-bold text-gray-900">Riwayat Pembayaran</h2>
             @if($kontrak->status === 'aktif')
                 <a href="{{ route('pembayaran.create', ['kontrak_id' => $kontrak->id]) }}" class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-md hover:bg-green-200">Catat Pembayaran</a>
             @endif
        </div>

        <div class="overflow-hidden border border-gray-200 rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tgl Bayar</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kontrak->pembayaran as $bayar)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $bayar->bulan }}/{{ $bayar->tahun }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $bayar->tanggal_bayar->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                         <td class="px-4 py-2 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bayar->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($bayar->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-500">Belum ada data pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

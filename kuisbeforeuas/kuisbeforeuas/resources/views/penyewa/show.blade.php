@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('penyewa.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1 bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Profil Penyewa</h1>
        
        <div class="flex items-center justify-center mb-6">
            <div class="h-24 w-24 bg-green-100 rounded-full flex items-center justify-center text-green-500 text-3xl font-bold uppercase">
                {{ substr($penyewa->nama_lengkap, 0, 2) }}
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                <dd class="mt-1 text-sm font-bold text-gray-900">{{ $penyewa->nama_lengkap }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $penyewa->nomor_telepon }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nomor KTP</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $penyewa->nomor_ktp }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $penyewa->pekerjaan }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Alamat Asal</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $penyewa->alamat_asal }}</dd>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Riwayat Sewa</h2>
        
        @if($penyewa->kontrak->count() > 0)
        <div class="overflow-hidden border border-gray-200 rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kamar</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($penyewa->kontrak as $kontrak)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $kontrak->kamar->nomor_kamar }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">
                            {{ $kontrak->tanggal_mulai->format('d/m/Y') }} - {{ $kontrak->tanggal_selesai->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kontrak->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($kontrak->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm font-medium">
                            <a href="{{ route('kontrak-sewa.show', $kontrak->id) }}" class="text-green-600 hover:text-green-900">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada riwayat sewa.</p>
            <div class="mt-4">
                 <a href="{{ route('kontrak-sewa.create') }}" class="text-sm font-medium text-green-600 hover:text-green-500">Buat Kontrak Baru &rarr;</a>
            </div>
        @endif
    </div>
</div>
@endsection

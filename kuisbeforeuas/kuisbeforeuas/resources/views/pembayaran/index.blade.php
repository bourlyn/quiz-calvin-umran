@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Data Pembayaran</h1>
    <a href="{{ route('pembayaran.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Catat Pembayaran Baru</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyewa / Kamar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($pembayaran as $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tanggal_bayar->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <div class="font-medium">{{ $item->kontrakSewa->penyewa->nama_lengkap }}</div>
                    <div class="text-xs text-gray-500">{{ $item->kontrakSewa->kamar->nomor_kamar }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->bulan }} / {{ $item->tahun }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('pembayaran.show', $item->id) }}" class="text-green-600 hover:text-green-900 mr-3">Detail</a>
                    <a href="{{ route('pembayaran.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                    <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pembayaran ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pembayaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

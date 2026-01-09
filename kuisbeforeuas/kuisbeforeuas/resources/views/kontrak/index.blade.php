@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Daftar Kontrak Sewa</h1>
    <a href="{{ route('kontrak-sewa.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Buat Kontrak Baru</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyewa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode Sewa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Bulan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($kontrak as $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $item->kamar->nomor_kamar }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->penyewa->nama_lengkap }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <div>{{ $item->tanggal_mulai->format('d M Y') }}</div>
                    <div class="text-xs text-gray-400">s/d {{ $item->tanggal_selesai->format('d M Y') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('kontrak-sewa.show', $item->id) }}" class="text-green-600 hover:text-green-900 mr-3">Detail</a>
                    <a href="{{ route('kontrak-sewa.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                    <form action="{{ route('kontrak-sewa.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kontrak ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data kontrak.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

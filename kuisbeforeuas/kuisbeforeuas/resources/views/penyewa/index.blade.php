@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Data Penyewa</h1>
    <a href="{{ route('penyewa.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Tambah Penyewa</a>
</div>

<div class="mb-6 bg-white p-4 rounded-lg shadow">
    <form action="{{ route('penyewa.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Nama, NIK, atau Telepon..." class="border-gray-300 focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border rounded-md p-2 flex-1">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-700">Cari</button>
    </form>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($penyewa as $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nomor_telepon }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->pekerjaan }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('penyewa.show', $item->id) }}" class="text-green-600 hover:text-green-900 mr-3">Detail</a>
                    <a href="{{ route('penyewa.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                    <form action="{{ route('penyewa.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus penyewa ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data penyewa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

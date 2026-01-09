@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Data Kamar</h1>
    <a href="{{ route('kamar.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Tambah Kamar</a>
</div>

<div class="mb-6 bg-white p-4 rounded-lg shadow">
    <form action="{{ route('kamar.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Nomor Kamar..." class="border-gray-300 focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border rounded-md p-2">
        
        <select name="tipe" class="border-gray-300 focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border rounded-md p-2">
            <option value="">Semua Tipe</option>
            <option value="standard" {{ request('tipe') == 'standard' ? 'selected' : '' }}>Standard</option>
            <option value="deluxe" {{ request('tipe') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
        </select>
        
        <select name="status" class="border-gray-300 focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border rounded-md p-2">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
        </select>
        
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">Filter</button>
    </form>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($kamar as $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nomor_kamar }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ $item->tipe }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('kamar.show', $item->id) }}" class="text-green-600 hover:text-green-900 mr-3">Detail</a>
                    <a href="{{ route('kamar.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                    <form action="{{ route('kamar.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data kamar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

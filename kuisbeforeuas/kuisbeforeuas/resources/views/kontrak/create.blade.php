@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('kontrak-sewa.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Buat Kontrak Sewa Baru</h1>

    @if($kamar->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Tidak ada kamar yang tersedia saat ini. <a href="{{ route('kamar.create') }}" class="font-medium underline hover:text-yellow-600">Tambah kamar baru</a> atau ubah status kamar yang ada.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('kontrak-sewa.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="penyewa_id" class="block text-sm font-medium text-gray-700">Penyewa</label>
            <select name="penyewa_id" id="penyewa_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                <option value="">-- Pilih Penyewa --</option>
                @foreach($penyewa as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_lengkap }} - {{ $p->nomor_ktp }}</option>
                @endforeach
            </select>
            @error('penyewa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="kamar_id" class="block text-sm font-medium text-gray-700">Kamar Tersedia</label>
            <select name="kamar_id" id="kamar_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required onchange="updateHarga(this)">
                <option value="">-- Pilih Kamar --</option>
                @foreach($kamar as $k)
                    <option value="{{ $k->id }}" data-harga="{{ $k->harga_bulanan }}">{{ $k->nomor_kamar }} ({{ ucfirst($k->tipe) }}) - Rp {{ number_format($k->harga_bulanan, 0, ',', '.') }}</option>
                @endforeach
            </select>
            @error('kamar_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                 <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                 <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                 @error('tanggal_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                 <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                 <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                 @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="harga_bulanan" class="block text-sm font-medium text-gray-700">Harga Sewa Bulanan (Rp)</label>
            <input type="number" name="harga_bulanan" id="harga_bulanan" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required readonly>
            <p class="text-xs text-gray-500 mt-1">Otomatis terisi dari data kamar.</p>
            @error('harga_bulanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
             <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700" {{ $kamar->isEmpty() ? 'disabled' : '' }}>Buat Kontrak</button>
        </div>
    </form>
</div>

<script>
    function updateHarga(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        if (harga) {
            document.getElementById('harga_bulanan').value = harga;
        } else {
            document.getElementById('harga_bulanan').value = '';
        }
    }
</script>
@endsection

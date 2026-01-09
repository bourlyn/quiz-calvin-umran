@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('pembayaran.index') }}" class="text-green-600 hover:text-green-900">&larr; Kembali</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Catat Pembayaran</h1>

    @if($kontrak->isEmpty())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
            <p class="text-sm text-red-700">Tidak ada kontrak aktif yang dapat dilakukan pembayaran.</p>
        </div>
    @endif

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="kontrak_sewa_id" class="block text-sm font-medium text-gray-700">Pilih Kontrak / Penyewa</label>
            <select name="kontrak_sewa_id" id="kontrak_sewa_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required onchange="updateTagihan(this)">
                <option value="">-- Pilih Kontrak --</option>
                @foreach($kontrak as $k)
                    <option value="{{ $k->id }}" data-harga="{{ $k->harga_bulanan }}" {{ request('kontrak_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->penyewa->nama_lengkap }} - Kamar {{ $k->kamar->nomor_kamar }} (Rp {{ number_format($k->harga_bulanan, 0, ',', '.') }}/bln)
                    </option>
                @endforeach
            </select>
            @error('kontrak_sewa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                 <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                 <select name="bulan" id="bulan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                     @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                     @endfor
                 </select>
                 @error('bulan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                 <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                 <input type="number" name="tahun" id="tahun" value="{{ date('Y') }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required min="2020" max="2030">
                 @error('tahun') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="jumlah_bayar" class="block text-sm font-medium text-gray-700">Jumlah Bayar (Rp)</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('jumlah_bayar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tanggal_bayar" class="block text-sm font-medium text-gray-700">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" value="{{ date('Y-m-d') }}" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
            @error('tanggal_bayar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                <option value="lunas">Lunas</option>
                <option value="tertunggak">Tertunggak (Belum Lunas)</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
            <textarea name="keterangan" id="keterangan" rows="2" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"></textarea>
             @error('keterangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-6">
            <label for="bukti_transfer" class="block text-sm font-medium text-gray-700">Bukti Transfer (Opsional)</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
            @error('bukti_transfer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700" {{ $kontrak->isEmpty() ? 'disabled' : '' }}>Simpan Pembayaran</button>
        </div>
    </form>
</div>

<script>
    function updateTagihan(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        if (harga) {
            document.getElementById('jumlah_bayar').value = harga;
        } else {
            document.getElementById('jumlah_bayar').value = '';
        }
    }
    
    // Auto-fill jika ada pre-selected value
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('kontrak_sewa_id');
        if (select.value) {
            updateTagihan(select);
        }
    });
</script>
@endsection

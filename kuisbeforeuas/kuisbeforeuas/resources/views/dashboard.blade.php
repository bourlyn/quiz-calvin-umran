@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Kamar</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalKamar }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-emerald-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-emerald-100 text-emerald-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Kamar Tersedia</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $kamarTersedia }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Kamar Terisi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $kamarTerisi }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-teal-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-100 text-teal-500 mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Penyewa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPenyewa }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
         <!-- Keuangan Card -->
         <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Keuangan (Bulan Ini)</h2>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg mb-4">
                <span class="text-gray-600">Pendapatan Masuk</span>
                <span class="text-xl font-bold text-green-600">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Pembayaran Tertunggak (Total)</span>
                <span class="text-xl font-bold text-red-600">{{ $pembayaranTertunggak }} Transaksi</span>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('pembayaran.index') }}" class="text-sm text-green-600 hover:text-green-800 font-medium">Lihat Detail Pembayaran &rarr;</a>
            </div>
         </div>
         
         <!-- Placeholder Chart/Table -->
         <div class="bg-white rounded-lg shadow p-6">
             <h2 class="text-lg font-bold text-gray-900 mb-4">Status Kamar</h2>
             <div class="flex flex-col space-y-4">
                 <div>
                     <div class="flex justify-between text-sm mb-1">
                         <span class="font-medium text-gray-700">Terisi</span>
                         <span class="font-medium text-gray-900">{{ $kamarTerisi }} / {{ $totalKamar }}</span>
                     </div>
                     <div class="w-full bg-gray-200 rounded-full h-2.5">
                         <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0 }}%"></div>
                     </div>
                 </div>
                 <div>
                     <div class="flex justify-between text-sm mb-1">
                         <span class="font-medium text-gray-700">Tersedia</span>
                         <span class="font-medium text-gray-900">{{ $kamarTersedia }} / {{ $totalKamar }}</span>
                     </div>
                     <div class="w-full bg-gray-200 rounded-full h-2.5">
                         <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $totalKamar > 0 ? ($kamarTersedia / $totalKamar) * 100 : 0 }}%"></div>
                     </div>
                 </div>
             </div>
             <div class="mt-8 text-right">
                 <a href="{{ route('kamar.index') }}" class="text-sm text-green-600 hover:text-green-800 font-medium">Kelola Kamar &rarr;</a>
             </div>
         </div>
    </div>
@endsection

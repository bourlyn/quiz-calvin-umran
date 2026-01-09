<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kost Manager') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-green-700 mb-4">Kost Manager</h1>
        <p class="text-gray-600 mb-8 text-lg">Sistem Manajemen Rumah Kost yang Efisien dan Terintegrasi</p>
        
        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-green-600 font-semibold rounded-lg shadow border border-green-600 hover:bg-green-50 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>

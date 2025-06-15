<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @include('components.navbaradmin')


    <title>Dashboard Admin</title>
</head>
<body>
    <div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center h-screen text-center">
    <h1 class="text-2xl font-bold transition-all">Dashboard Admin <span class="text-orange-500">Lapor.in</span></h1>
    <p class="text-gray-700 transition-all">
        {{-- Selamat Datang {{ session('nama') ?? 'Admin' }} --}}
        halo
        
    </p>
    <h2>jangan</h2>
</div>
</body>
</html>
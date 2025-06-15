<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Tambah admin</title>
</head>
<body>
    @include('components.navbaradmin')
    <div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Tambah Admin</h2>
        <form method="POST" action="{{ route('admin.store') }}">
            @csrf
            <label class="block font-semibold">Nama:</label>
            <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg mb-3" required>
            <label class="block font-semibold">Email:</label>
            <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg mb-3" required>
            <label class="block font-semibold">Password:</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg mb-3" required>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.profiladmin') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </form>
    </div>
</div>
    
</body>
</html>
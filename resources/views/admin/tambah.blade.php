<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>tambah profil</title>
</head>
<body>
    <div class="p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Tambah Admin</h2>
    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-bold">Nama</label>
            <input type="text" name="nama" class="w-full border px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold">Email</label>
            <input type="email" name="email" class="w-full border px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold">Password</label>
            <input type="password" name="password" class="w-full border px-4 py-2" required>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
    </form>
</div>
</body>
</html>
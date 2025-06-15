<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>edit admin</title>
</head>
<body>
    <div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-yellow-600 mb-4">Ubah Admin</h2>
        <form method="POST" action="{{ route('admin.update', $admin->id_admin) }}">
            @csrf @method('PUT')
            <label class="block font-semibold">Nama:</label>
            <input type="text" name="nama" value="{{ $admin->nama }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>
            <label class="block font-semibold">Email:</label>
            <input type="email" name="email" value="{{ $admin->email }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>
            <label class="block font-semibold">Password Lama:</label>
            <input type="password" name="current_password" class="w-full px-4 py-2 border rounded-lg mb-3">
            <label class="block font-semibold">Password Baru (opsional):</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg mb-3">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Update</button>
            <a href="{{ route('admin.profiladmin') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
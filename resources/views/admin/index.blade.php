<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Kelola Admin</title>
</head>
<body>
    @include('components.navbaradmin')
    <div class="p-6">
    <h2 class="text-3xl font-bold mb-6">Daftar Admin</h2>
    <a href="{{ route('admin.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Admin</a>
    <table class="w-full mt-4 border">
        <thead class="bg-black text-white">
            <tr>
                <th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id_admin }}</td>
                <td>{{ $admin->nama }}</td>
                <td>{{ $admin->email }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.edit', $admin->id_admin) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                    <form method="POST" action="{{ route('admin.destroy', $admin->id_admin) }}">
                        @csrf @method('DELETE')
                        <input type="password" name="password" placeholder="Konfirmasi Password" required>
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @include('components.navbaradmin')
    <title>profil admin</title>
</head>
<body>
    
    <div class="p-6 ml-64"> <!-- Tambahkan margin kiri untuk menghindari tumpang tindih -->
        <h2 class="text-3xl font-bold text-black mb-6">Daftar Admin</h2>
        
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Tambah <i class="fa fa-plus"></i>
            </a>
        </div>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead class="bg-black text-white">
                <tr>
                    <th class="p-3">User  ID</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr class="border-t hover:bg-gray-100">
                    <td class="p-3">{{ $admin->id_admin }}</td>
                    <td class="p-3">{{ $admin->nama }}</td>
                    <td class="p-3">{{ $admin->email }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.edit', $admin->id_admin) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                        <a href="{{ route('admin.destroy', $admin->id_admin) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

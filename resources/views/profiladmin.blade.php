<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100">

@include('components.navbaradmin')

<div id="content" class="flex-1 p-6 md:ml-64 flex flex-col items-center">
    <h2 class="text-3xl font-bold text-black mb-6">Daftar Admin</h2>

    <div class="w-full max-w-5xl">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.tambahadmin') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Tambah <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg">
            <table class="w-full text-sm text-left border border-black">
                <thead class="bg-black text-white text-base">
                    <tr>
                        <th class="px-6 py-4">User ID</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-20 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-black">
                    @foreach ($admins as $admin)
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="px-6 py-4">{{ $admin->id_admin }}</td>
                            <td class="px-6 py-4">{{ $admin->nama }}</td>
                            <td class="px-6 py-4">{{ $admin->email }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('admin.ubahadmin', $admin->id_admin) }}"
                                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-all">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
                                </a>
                                <a href="{{ route('admin.hapusadmin', $admin->id_admin) }}"
                                   class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition-all">
                                    <i class="fa-solid fa-trash">Hapus admin</i>
                                </a>
                                @if (session('success'))
    {{-- <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
@endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

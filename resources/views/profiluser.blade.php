<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    @vite('resources/css/app.css')

    <script>
        function confirmSubmit() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @include('components.navbaradmin')

    <div id="content" class="flex-1 p-6 md:ml-64 flex flex-col items-center">
        <h2 class="text-2xl font-bold text-orange-700 mb-6 text-center">Daftar User</h2>

        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.ubahstatususer') }}" method="POST" onsubmit="return confirmSubmit()" class="w-full">
            @csrf
            <div class="w-full overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full text-sm text-left border border-orange-700">
                    <thead class="bg-orange-700 text-white">
                        <tr>
                            <th class="px-4 py-3">User ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">No.Telp</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Jenis Kelamin</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-orange-100 transition">
                                <td class="px-4 py-3">{{ $user->id_user }}</td>
                                <td class="px-4 py-3">{{ $user->username }}</td>
                                <td class="px-4 py-3">{{ $user->no_telp }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->jenis_kelamin }}</td>
                                <td class="px-4 py-3">{{ $user->alamat }}</td>
                                <td class="px-4 py-3">
                                    <select name="status[{{ $user->id_user }}]" class="w-full px-2 py-1 border rounded-md">
                                        <option value="Aktif" {{ $user->status_user == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ $user->status_user == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full mt-6 flex">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-semibold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>
</html>

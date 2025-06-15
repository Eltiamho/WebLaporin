<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @include('components.navbaradmin')
    <title>Daftar Instansi</title>
</head>
<body>
    <div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
    <h2 class="text-3xl font-bold text-orange-700 mb-6">Daftar instansi</h2>

    <div class="w-full max-w-5xl">
        <div class="flex justify-end mb-4">
            <a href="{{ url('/admin/tambahinstansi') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-l hover:bg-green-700">
                Tambah <i class="fa-solid fa-plus"></i> 
            </a>
        </div>

        <form action="{{ url('/admin/prosesubahstatusinstansi') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')">
            @csrf
            <div class="overflow-x-auto bg-white shadow-lg">
                <table class="w-full text-sm text-left border border-orange-700">
                    <thead class="bg-orange-700 text-white text-base">
                        <tr>
                            <th class="px-6 py-4">ID instansi</th>
                            <th class="px-6 py-4">Nama instansi</th>
                            <th class="px-6 py-4">Informasi Kontak</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-20 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-orange-200">
                        @foreach ($instansi as $data)
                        <tr class="hover:bg-orange-100 transition-all">
                            <td class="px-6 py-4">{{ $data->id_instansi }}</td>
                            <td class="px-6 py-4">{{ $data->nama_instansi }}</td>
                            <td class="px-6 py-4">{{ $data->Kontak }}</td>
                            <td class="px-6 py-4">
                                <select name="status[{{ $data->id_instansi }}]" class="status-dropdown text-sm w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500">
                                    <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ $data->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('admin.editinstansi', $data->id_instansi) }}" 
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit 
                                </a>
                                <a href="{{ url('/admin/hapusinstansi/'.$data->id_instansi) }}"  
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full mt-5">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-l hover:bg-orange-700">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
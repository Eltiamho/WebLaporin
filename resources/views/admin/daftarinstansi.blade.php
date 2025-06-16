<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @include('components.navbaradmin')
    <title>Daftar Instansi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                                <!-- Tombol Edit -->
                                <button type="button"
                                    onclick="openEditModal('{{ $data->id_instansi }}', '{{ $data->nama_instansi }}', '{{ $data->Kontak }}')"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </button>

                                <!-- Form Hapus -->
                                <form action="{{ route('instansi.hapus', ['id' => $data->id_instansi]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
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

<!-- Modal Edit Instansi -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-auto">
        <h2 class="text-xl font-semibold text-orange-600 mb-4">Edit Instansi</h2>
        <form method="POST" action="{{ route('admin.ubahinstansi') }}">
            @csrf
            <input type="hidden" name="id_instansi" id="edit_id_instansi" value="">
        
            <label class="block font-semibold">ID Instansi:</label>
            <input type="text" id="display_id_instansi" class="w-full px-4 py-2 border rounded-lg mb-3 bg-gray-200" readonly>
        
            <label class="block font-semibold mb-1">Nama Instansi:</label>
            <input type="text" name="nama_instansi" id="edit_nama_instansi" class="w-full border px-3 py-2 rounded mb-3" required>
        
            <label class="block font-semibold mb-1">Kontak:</label>
            <input type="text" name="kontak" id="edit_kontak" class="w-full border px-3 py-2 rounded mb-4" required>
        
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
            </div>
        </form>
        
        <script>
            function openEditModal(id, nama, kontak) {
                document.getElementById('edit_id_instansi').value = id;
                document.getElementById('display_id_instansi').value = id;
                document.getElementById('edit_nama_instansi').value = nama;
                document.getElementById('edit_kontak').value = kontak;
        
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            }
        
            function closeModal() {
                document.getElementById('editModal').classList.add('hidden');
                document.getElementById('editModal').classList.remove('flex');
            }
        </script>
        

</body>
</html>

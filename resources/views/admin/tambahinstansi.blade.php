<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Instansi</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold text-center text-orange-700 mb-4">Tambah Instansi</h2>

    <form action="{{ route('admin.storeinstansi') }}" method="POST">
        @csrf

        <label class="block font-semibold">Nama Instansi:</label>
        <input type="text" name="nama_instansi" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Kontak:</label>
        <input type="text" name="Kontak" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Status:</label>
        <select name="status" class="w-full px-4 py-2 border rounded-lg mb-3 bg-white focus:ring-2 focus:ring-orange-500 focus:outline-none">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>

        <div class="flex justify-between mt-5">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.daftarin_stansi') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>

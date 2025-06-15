<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Instansi</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-orange-500 mb-4">Edit Instansi</h2>

    <form action="{{ route('admin.ubahinstansi') }}" method="POST">
        @csrf
        <input type="hidden" name="id_instansi" value="{{ $instansi->id_instansi }}">

        <label class="block font-semibold mb-1">ID Instansi:</label>
        <input type="text" value="{{ $instansi->id_instansi }}" class="w-full px-4 py-2 border rounded-lg mb-3 bg-gray-200" readonly>

        <label class="block font-semibold mb-1">Nama Instansi:</label>
        <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $instansi->nama_instansi) }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold mb-1">Informasi Kontak:</label>
        <input type="text" name="Kontak" value="{{ old('Kontak', $instansi->kontak) }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <div class="flex justify-between mt-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                <i class="fa-solid fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.daftarin_stansi') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

</body>
</html>

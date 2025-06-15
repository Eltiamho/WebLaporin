<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Instansi</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold text-center text-orange-500 mb-4">Edit Instansi</h2>
    
    <form action="{{ route('admin.ubahinstansi') }}" method="POST">
        @csrf
        <input type="hidden" name="id_instansi" value="{{ $instansi->id_instansi }}">

        <label class="block font-semibold">ID Instansi:</label>
        <input type="text" value="{{ $instansi->id_instansi }}" class="w-full px-4 py-2 border rounded-lg mb-3 bg-gray-200" readonly>

        <label class="block font-semibold">Nama Instansi:</label>
        <input type="text" name="nama_instansi" value="{{ $instansi->nama_instansi }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Kontak:</label>
        <input type="text" name="kontak" value="{{ $instansi->Kontak }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <div class="flex justify-between mt-5">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.daftarinstansi') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>

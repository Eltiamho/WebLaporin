<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>REGISTER</title>
</head>
<body>

<div class="bg-white rounded shadow-md max-w-4xl mx-auto p-8 mt-24">
    <h2 class="text-2xl font-bold mb-10 text-center"><i class="fa-solid fa-user px-2"></i>Daftar Akun</h2>
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <strong>Terjadi kesalahan:</strong>
        <ul class="list-disc list-inside mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Tempat Tinggal Saat Ini</label>
                <input type="text" name="tempat" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <select class="w-full p-2 border border-gray-300 rounded" name="kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">No. Telp Aktif</label>
                <input type="tel" name="no" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full text-white bg-orange-600 hover:bg-orange-700 py-2 rounded-md">
                    Daftar
                </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Ubah Profil</title>
</head>
<body>
    @include('components.navbar')
    <div class="relative w-full h-[275px] overflow-hidden">
    @include('components.navbar') {{-- Sesuaikan jika pakai navbar lain --}}
    <section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex" style="background-image: url('{{ asset('Assets/bg about.png') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative px-10 flex items-center gap-4">
            <img src="{{ asset('profile-pic.jpg') }}" alt="Profile Picture" class="w-24 h-24 rounded-full border-2 border-white">
            <h1 class="text-3xl font-bold text-white">Profil</h1>
        </div>
    </section>
</div>

<div class="container mx-auto flex flex-col lg:flex-row gap-6 p-6">
    <!-- Sidebar -->
    <aside class="w-full lg:w-1/6 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Aksi</h2>
        <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700">Ubah Profil</button>
    </aside>

    <!-- Modal Edit Profil -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] md:w-2/3 lg:w-1/3">
            <h2 class="text-lg font-semibold mb-4 text-orange-500">Edit Profil</h2>
            <form method="POST" action="{{ route('user.update') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->username) }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Tempat Tinggal</label>
                    <input type="text" name="tempat" value="{{ old('tempat', $user->alamat) }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded">
                        <option value="Laki-laki" @selected($user->jenis_kelamin == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected($user->jenis_kelamin == 'Perempuan')>Perempuan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">No. Telp</label>
                    <input type="tel" name="no" value="{{ $user->no_telp }}" class="w-full p-2 border rounded" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded" readonly>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Informasi Personal -->
    <main class="w-full lg:w-3/4 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Informasi Personal</h2>
        <div class="space-y-2">
            <div>
                <label class="block mb-2 text-sm font-semibold">Nama</label>
                <input type="text" value="{{ $user->username }}" class="w-full p-2 border rounded font-semibold" readonly>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold">Alamat</label>
                <input type="text" value="{{ $user->alamat }}" class="w-full p-2 border rounded font-semibold" readonly>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold">Jenis Kelamin</label>
                <input type="text" value="{{ $user->jenis_kelamin }}" class="w-full p-2 border rounded font-semibold" readonly>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold">No. Telp</label>
                <input type="text" value="{{ $user->no_telp }}" class="w-full p-2 border rounded font-semibold" readonly>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold">Email</label>
                <input type="email" value="{{ $user->email }}" class="w-full p-2 border rounded font-semibold" readonly>
            </div>
        </div>
    </main>
</div>
</body>
</html>
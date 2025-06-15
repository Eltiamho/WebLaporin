<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Edit Admin</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/admin/update') }}" method="POST">
        @csrf
        <input type="hidden" name="id_admin" value="{{ $admin->id_admin }}">

        <label class="block font-semibold">Admin ID:</label>
        <input type="text" value="{{ $admin->id_admin }}" class="w-full px-4 py-2 border rounded-lg mb-3 bg-gray-200" readonly>

        <label class="block font-semibold">Nama:</label>
        <input type="text" name="nama" value="{{ $admin->nama }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Email:</label>
        <input type="email" name="email" value="{{ $admin->email }}" class="w-full px-4 py-2 border rounded-lg mb-3" required>

        <label class="block font-semibold">Password Sebelumnya:</label>
        <input type="password" id="current_password" class="w-full px-4 py-2 border rounded-lg mb-3" disabled placeholder="Hidden for security">

        <label class="block font-semibold">Password Baru:</label>
        <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg mb-3">

        <div class="text-gray-500">
            <input type="checkbox" onclick="togglePassword()"> Show password
        </div>

        <script>
            function togglePassword() {
                var pass2 = document.getElementById("password");
                pass2.type = pass2.type === "password" ? "text" : "password";
            }
        </script>

        <div class="flex justify-between mt-5">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
            <a href="{{ url('/admin/list') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('components.navbar')

    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center text-red-600 mb-6">Ubah Password</h2>

            @if(session('success'))
                <div class="text-green-600 mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="text-red-600 mb-4">{{ session('error') }}</div>
            @endif

            <form action="{{ route('lupapassword.reset') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Email</label>
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Password Baru</label>
                    <input type="password" id="pass1" name="pass_new" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold">Konfirmasi Password</label>
                    <input type="password" id="pass2" name="pass_conf" class="w-full p-2 border border-gray-300 rounded" required>
                    <label class="text-sm"><input type="checkbox" onclick="togglePassword()"> Show Password</label>
                </div>
                <div class="flex justify-between">
                    <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const p1 = document.getElementById("pass1");
            const p2 = document.getElementById("pass2");
            const type = p1.type === "password" ? "text" : "password";
            p1.type = type;
            p2.type = type;
        }
    </script>
</body>
</html>

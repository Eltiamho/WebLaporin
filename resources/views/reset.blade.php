<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    @vite('resources/css/app.css')

    <!-- Font Awesome CDN untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Ks+uB9D4Zejy6d3uKH/Sl0HbMsm3NzXEFysZk+jM5VQF6yzgbvhf3ZBgx9w1U1g64FnNN9h3AASUc27xkkZJAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 relative">

    <!-- Tombol Kembali -->
    

    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <a href="{{ route('login') }}" class=" top-4 left-4 text-sm text-blue-600 hover:underline">
            ← Kembali
        </a>
        <h2 class="text-2xl font-semibold mb-4 text-center">Atur Password Baru</h2>

        @if (session('error'))
            <div class="text-red-600 mb-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="text-green-600 mb-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('lupapassword.reset') }}" method="POST">
            @csrf

            <input type="hidden" name="email" value="{{ session('reset_email') }}">

            <!-- Password -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium">Password Baru</label>
                <input type="password" id="password" name="password" class="w-full border p-2 rounded pr-10" required>
                <i class="fa-solid fa-eye absolute right-3 top-9 text-gray-500 cursor-pointer" onclick="togglePassword('password', this)"></i>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border p-2 rounded pr-10" required>
                <i class="fa-solid fa-eye absolute right-3 top-9 text-gray-500 cursor-pointer" onclick="togglePassword('password_confirmation', this)"></i>
                @error('password_confirmation')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-orange-600 text-white w-full py-2 rounded hover:bg-orange-700">
                Simpan Password Baru
            </button>
        </form>
    </div>

    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>

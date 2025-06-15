<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Email</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md relative">

        <!-- Tombol kembali -->
        <a href="{{ route('login') }}" class="absolute top-4 left-4 text-sm text-blue-600 hover:underline">
            ← Kembali
        </a>

        <h2 class="text-2xl font-semibold mb-4 text-center">Lupa Password</h2>

        @if (session('error'))
            <div class="text-red-600 mb-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="text-green-600 mb-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('lupapassword.verify.send') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Masukkan Email Anda</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-orange-600 text-white w-full py-2 rounded hover:bg-orange-700">Kirim Kode Verifikasi</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Kode</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
   
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <a href="{{ route('login') }}" class=" top-4 left-4 text-sm text-blue-600 hover:underline">
            ← Kembali
        </a>
        <h2 class="text-2xl font-semibold mb-4 text-center">Kode Verifikasi</h2>

        @if (session('error'))
            <div class="text-red-600 mb-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="text-green-600 mb-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('lupapassword.verifycode') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Kode Verifikasi</label>
                <input type="text" name="kode" class="w-full border p-2 rounded" required>
                @error('kode')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">Verifikasi</button>
        </form>
    </div>
</body>
</html>

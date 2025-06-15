<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Form donasi</title>
</head>
<body>
    @include('components.navbar')

    <section class="flex-grow flex items-center justify-center mt-20 py-12 px-4">
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-orange-700 mb-6 text-center leading-snug">
            Form Donasi untuk:
            <span class="text-gray-800 block mt-2">{{ $laporan->judul }}</span>
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('proses_donasi') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="id_laporan" value="{{ $laporan->id_laporan }}">

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nama Donatur</label>
                <input type="text" name="nama" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ $email }}" readonly class="w-full border rounded p-2 bg-gray-100">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nominal Donasi</label>
                <input type="number" name="jumlah" min="1000" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Pesan</label>
                <textarea name="pesan" rows="3" class="w-full border rounded p-2 resize-none"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">
                    Donasi Sekarang
                </button>
            </div>
        </form>
    </div>
</section>
    @include('components.footer')

</body>
</html>
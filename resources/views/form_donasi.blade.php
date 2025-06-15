<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Form Donasi</title>
</head>
<body>
    @include('components.navbar')

    <section class="flex-grow flex items-center justify-center mt-20 py-12 px-4">
        <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-6 relative">

            <div class="mb-4">
                <button type="button" onclick="window.location.href='{{ route('lapor') }}'" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    ← Kembali
                </button>
            </div>  

           

            {{-- Total Donasi --}}
            <div class="mb-6 text-center">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Total Donasi Terkumpul</h2>
                <p class="text-3xl font-bold text-orange-600">Rp {{ number_format($total_donasi, 0, ',', '.') }}</p>
            </div>

            {{-- Daftar Donatur --}}
            <div class="mb-8">
                <h3 class="text-md font-semibold text-gray-800 mb-3 border-b pb-1">Daftar Donatur Terbaru</h3>
                <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                    @forelse($daftar_donatur as $donatur)
                        <li class="py-3">
                            <p class="font-semibold text-gray-900">{{ $donatur->nama ?: 'Anonymous' }}</p>
                            <p class="text-sm text-gray-700">Donasi: Rp {{ number_format($donatur->jumlah, 0, ',', '.') }}</p>
                            @if($donatur->pesan)
                                <p class="italic text-sm text-gray-500"> pesan: "{{ $donatur->pesan }}"</p>
                            @endif
                        </li>
                    @empty
                        <li class="text-gray-500 text-sm">Belum ada donatur.</li>
                    @endforelse
                </ul>
            </div>
            <h1 class="text-2xl font-bold text-gray-800  mb-6 text-center leading-snug">
                Form Donasi untuk:
                <span class="text-orange-700 block mt-2">{{ $laporan->judul }}</span>
            </h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif
            {{-- Form Donasi --}}
            <form action="{{ route('proses_donasi') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="id_laporan" value="{{ $laporan->id_laporan }}">

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Nama Donatur</label>
                    <input type="text" name="nama" placeholder="Kosongkan untuk donasi anonim" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $email }}" readonly class="w-full border rounded p-2 bg-gray-100">
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Nominal Donasi</label>
                    <input type="text" name="jumlah" id="jumlah" min="1000" max="5000000" class="w-full border rounded p-2" required oninput="formatJumlah(this)">
                    @error('jumlah')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <small class="text-sm text-gray-500">Minimal: 1.000 | Maksimal: 5.000.000</small>
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Pesan</label>
                    <textarea name="pesan" rows="3" class="w-full border rounded p-2 resize-none"></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">
                        Donasi Sekarang
                    </button>

                    @if ($errors->any())
                        <div class="text-red-500 mt-3 text-sm text-left">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>

    @include('components.footer')

    <script>
        function formatJumlah(input) {
            let rawValue = input.value.replace(/\./g, '').replace(/[^\d]/g, '');
            let numericValue = parseInt(rawValue);
            if (numericValue > 5000000) numericValue = 5000000;

            if (!isNaN(numericValue)) {
                input.value = numericValue.toLocaleString('id-ID');
            } else {
                input.value = '';
            }
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const jumlahInput = document.getElementById('jumlah');
            jumlahInput.value = jumlahInput.value.replace(/\./g, '');
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Laporan</title>
</head>
<body>
    @include('components.navbar')
    <!-- resources/views/lapor.blade.php -->

@section('content')
    <div class="relative w-full h-[400px] overflow-hidden mt-10">
        <!-- Slides -->
        <div class="relative w-full h-full">
            <div class="slide fade absolute w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
                <img src="{{ asset('assets/bencana alam.jpg') }}" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-6 text-white">
                    <h2 class="text-3xl font-bold">Bencana Alam</h2>
                    <p class="text-lg max-w-md">Bantuan sampai lebih cepat.</p>
                </div>
            </div>
            <div class="slide fade absolute w-full h-full hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
                <img src="{{ asset('assets/Demo.jpg') }}" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-6 text-white">
                    <h2 class="text-3xl font-bold">Ketidakadilan</h2>
                    <p class="text-lg max-w-md">Menindak lanjut semua ketidakadilan.</p>
                </div>
            </div>
            <div class="slide fade absolute w-full h-full hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0da4] to-transparent"></div>
                <img src="{{ asset('assets/kerusakan infrastruktur.jpg') }}" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-6 text-white">
                    <h2 class="text-3xl font-bold">Kerusakan Infrastruktur</h2>
                    <p class="text-lg max-w-md">Infrastruktur rusak cepat pulih.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-6">
        <div class="flex flex-col items-center text-center py-16">
            <h1 class="text-5xl font-bold text-black">
                @auth
                    Selamat Datang {{ Auth::user()->nama }} di Lapor.In
                @else
                    Selamat Datang di Lapor.In
                @endauth
            </h1>
            <p class="text-lg text-gray-600 mt-4">Platform pengaduan yang cepat dan responsif</p>
        </div>
    </div>

    <!-- Form Laporan -->
    <div class="max-w-4xl mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl text-black font-semibold text-center mb-6">Sampaikan Laporan Anda</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="judul" class="block text-sm font-semibold text-gray-700">Ketikan Judul Laporan Anda</label>
                    <input type="text" id="judul" name="judul" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-4">
                    <label for="isi" class="block text-sm font-semibold text-gray-700">Ketikan Isi Laporan Anda</label>
                    <textarea id="isi" name="isi" class="w-full mt-2 px-4 py-2 border rounded-lg" rows="4" required>{{ old('isi') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('tanggal') }}" required>
                </div>

                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                    <input type="text" id="lokasi" name="lokasi" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('lokasi') }}" required>
                </div>

                <div class="mb-4">
                    <label for="instansi" class="block text-sm font-semibold text-gray-700">Pilih Instansi Tujuan</label>
                    <select id="instansi" name="instansi" class="w-full mt-2 px-4 py-2 border rounded-lg" required>
                        <option value="" disabled selected>Pilih instansi</option>
                        @foreach ($instansi as $row)
                            <option value="{{ $row->id_instansi }}">{{ $row->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-semibold text-gray-700">Pilih Kategori Laporan Anda</label>
                    <select id="kategori" name="kategori" class="w-full mt-2 px-4 py-2 border rounded-lg" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Bencana Alam">Bencana Alam</option>
                        <option value="Aduan">Aduan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="lampiran" class="block text-sm font-semibold text-gray-700">Upload Bukti Aduan</label>
                    <input type="file" id="lampiran" name="lampiran" class="w-full mt-2 px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4 flex items-center">
                    <input type="radio" id="anonim" name="privasi" value="Anonim" class="mr-2" required>
                    <label for="anonim" class="text-sm">Anonymous</label>
                    <input type="radio" id="publik" name="privasi" value="Publik" class="ml-4 mr-2" required>
                    <label for="publik" class="text-sm">Publik</label>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded-full text-l w-full hover:bg-orange-700">Lapor!</button>
                </div>
            </form>
        </div>
    </div>
@endsection

</body>
</html>
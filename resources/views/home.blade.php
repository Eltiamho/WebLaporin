<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
</head>
<body>
    @include('components.navbar')
    {{-- <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1> --}}
  <div class="relative w-full h-[400px] overflow-hidden">
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
        <!-- Tombol & Indikator -->
        <button class="prev absolute top-1/2 left-3 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-4 rounded-full text-2xl hover:bg-opacity-75 transition">&#10094;</button>
        <button class="next absolute top-1/2 right-3 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-4 rounded-full text-2xl hover:bg-opacity-75 transition">&#10095;</button>
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <span class="dot w-4 h-4 bg-white rounded-full cursor-pointer"></span>
            <span class="dot w-4 h-4 bg-gray-400 rounded-full cursor-pointer"></span>
            <span class="dot w-4 h-4 bg-gray-400 rounded-full cursor-pointer"></span>
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="container mx-auto p-6">
        <div class="flex flex-col items-center text-center py-16">
            <h1 class="text-5xl font-bold text-black">
                {{-- Mengganti logika session dengan helper Auth Laravel --}}
                @auth
                    Selamat Datang {{ Auth::user()->nama }} di Lapor.In
                @else
                    Selamat Datang di Lapor.In
                @endauth
            </h1>
            <p class="text-lg text-gray-600 mt-4">Platform pengaduan yang cepat dan responsif</p>
            <a href="#formaduan" class="mt-6 px-6 py-3 border-none bg-orange-600 text-white rounded-lg hover:bg-orange-700">Buat Laporan</a>
        </div>
    </div>

    {{-- Proses Laporan (Tidak perlu diubah, sudah HTML murni) --}}
    <div class="max-w-6xl mx-auto relative overflow-x-auto">
    <div class="flex items-center gap-6 md:gap-8 relative z-10 w-full">
        <!-- Langkah 1 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-green-600 text-white text-2xl rounded-full border-4 border-white shadow-lg">
                ✍️
            </div>
            <h3 class="font-semibold mt-4">Tulis Laporan</h3>
            <p class="text-gray-600 text-sm">Laporkan keluhan atau aspirasi Anda dengan jelas dan lengkap</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 2 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-blue-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                🔍
            </div>
            <h3 class="font-semibold mt-4">Proses Verifikasi</h3>
            <p class="text-gray-600 text-sm">Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan ke instansi berwenang</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 3 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-green-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                ✅
            </div>
            <h3 class="font-semibold mt-4">Proses Tindak Lanjut</h3>
            <p class="text-gray-600 text-sm">Dalam 5 hari, instansi akan menindaklanjuti dan membalas laporan Anda</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 4 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-gray-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                💬
            </div>
            <h3 class="font-semibold mt-4">Beri Tanggapan</h3>
            <p class="text-gray-600 text-sm">Anda dapat menanggapi kembali balasan dalam waktu 10 hari</p>
        </div>

        <div class="h-1 w-1/5 bg-gray-300"></div> <!-- Garis penghubung -->

        <!-- Langkah 5 -->
        <div class="flex flex-col items-center text-center w-1/5 min-w-[200px]">
            <div class="w-16 h-16 flex items-center justify-center bg-white text-purple-500 text-2xl rounded-full border-4 border-gray-300 shadow-lg">
                ✔️
            </div>
            <h3 class="font-semibold mt-4">Selesai</h3>
            <p class="text-gray-600 text-sm">Laporan Anda akan terus ditindaklanjuti hingga selesai</p>
        </div>
    </div>
</div>

    {{-- Section Informasi (Tidak perlu diubah, sudah HTML murni) --}}
    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 py-16 ">
            <div class="p-6 bg-white shadow-lg rounded-lg ">
                <h3 class="text-xl font-semibold flex items-center">
                    Cepat <span class="ml-2">🚀</span>
                </h3>
                <p class="text-gray-600 mt-2">Laporan Anda akan diproses dengan cepat dan akurat.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold flex items-center">
                    Akurat <span class="ml-2">🎯</span>
                </h3>
                <p class="text-gray-600 mt-2">Data yang Anda kirimkan akan diverifikasi secara sistematis.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold flex items-center">
                    Terpercaya <span class="ml-2">✅</span>
                </h3>
                <p class="text-gray-600 mt-2">Privasi dan keamanan laporan Anda adalah prioritas kami.</p>
            </div>
        </div>

    {{-- Form Aduan --}}
    <div id="formaduan" class="max-w-4xl mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl text-black font-semibold text-center mb-6">Sampaikan Laporan Anda</h2>
            
            {{-- Menampilkan pesan sukses atau error --}}
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

            <form id="laporanForm" action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf {{-- Token keamanan wajib di Laravel --}}

                {{-- Judul Laporan --}}
                <div class="mb-4">
                    <label for="judul" class="block text-sm font-semibold text-gray-700">Ketikan Judul Laporan Anda</label>
                    <input type="text" id="judul" name="judul" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('judul') }}" required>
                </div>

                {{-- Isi Laporan --}}
                <div class="mb-4">
                    <label for="isi" class="block text-sm font-semibold text-gray-700">Ketikan Isi Laporan Anda</label>
                    <textarea id="isi" name="isi" class="w-full mt-2 px-4 py-2 border rounded-lg" rows="4" required>{{ old('isi') }}</textarea>
                </div>
                
                {{-- Tanggal, Lokasi (sama seperti judul, tambahkan old() jika perlu) ... --}}
                {{-- Tanggal --}}
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('tanggal') }}" required>
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                    <input type="text" id="lokasi" name="lokasi" class="w-full mt-2 px-4 py-2 border rounded-lg" value="{{ old('lokasi') }}" required>
                </div>
                
                {{-- Instansi Tujuan --}}
                <div class="mb-4">
                    <label for="instansi" class="block text-sm font-semibold text-gray-700">Pilih Instansi Tujuan</label>
                    <select id="instansi" name="instansi" class="w-full mt-2 px-4 py-2 border rounded-lg" required>
                        <option value="" disabled selected>Pilih instansi</option>
                        {{-- Mengganti loop PHP dengan Blade --}}
                        @foreach ($data_instansi as $row)
                            <option value="{{ $row->id_instansi }}">{{ $row->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Kategori, Lampiran, Privasi ... --}}

                <!-- Kategori Laporan -->
                    <div class="mb-4">
                        <label for="kategori" class="block text-sm font-semibold text-gray-700">Pilih Kategori Laporan Anda</label>
                        <select id="kategori" name="kategori" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="Bencana Alam">Bencana Alam</option>
                            <option value="Aduan">Aduan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="lampiran" class="block text-sm font-semibold text-gray-700">Upload Bukti Aduan</label>
                        <input type="file" id="lampiran" name="lampiran" class="w-full mt-2 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
                    </div>

                    <!-- Pilihan Anonim atau Rahasia -->
                    <div class="mb-4 flex items-center">
                        <input type="radio" id="anonim" name="privasi" value="Privat" class="mr-2" required>
                        <label for="anonim" class="text-sm">Anonymous</label>
                        <input type="radio" id="publik" name="privasi" value="Publik" class="ml-4 mr-2" required>
                        <label for="publik" class="text-sm">Publik</label>
                        <p class="text-red-500 text-sm mt-1 hidden" id="error-privacy">Pilih salah satu privasi!</p>
                    </div>
                
                <div class="text-center">
                    <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded-full text-l w-full hover:bg-orange-700">Lapor!</button>
                </div>
            </form>
        </div>
    </div>
    @include('components.footer')
    
</body>
</html>
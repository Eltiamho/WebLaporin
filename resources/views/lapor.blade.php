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

    <section class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-700 mb-8 mt-10">Laporan Publik</h1>

    @if ($lapor->count())
        <div class="space-y-6">
            @foreach ($lapor as $row)
                @php
                    $nama = $row->privasi === 'Anonim' ? 'Anonim' : $row->username;
                    $status = strtolower($row->status ?? '');
                    $statusColor = match($status) {
                        'selesai' => 'bg-green-100 text-green-800',
                        'diproses' => 'bg-blue-100 text-blue-800',
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'batal' => 'bg-red-100 text-red-800',
                        default => 'bg-gray-100 text-gray-800'
                    };
                    $showCheck = ($status === 'selesai');
                    $isBencanaAlam = ($row->kategori === 'Bencana Alam');
                    $isActiveDonasi = ($isBencanaAlam && in_array($status, ['selesai', 'diproses']));
                @endphp

                <div class="rounded-lg shadow-md p-6 mb-6 border hover:shadow-lg transition-shadow duration-300 bg-white border-gray-200">
                    <span class="px-3 py-1.5 text-sm font-semibold rounded-full mb-4 inline-block {{ $statusColor }}">
                        {{ ucfirst($status) }}
                    </span>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                <span>{{ strtoupper(substr($nama, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-lg">{{ $nama }}</p>
                                <p class="text-gray-500">{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</p>
                            </div>
                        </div>
                        @if ($showCheck)
                            <div class="text-green-600 text-2xl" title="Laporan selesai">
                                <i class="fa-solid fa-check fa-lg" style="color: #00ff4c;"></i>
                            </div>
                        @endif
                    </div>

                    <h2 class="text-xl font-bold text-teal-700 mb-3">{{ $row->judul }}</h2>
                    <p class="text-gray-700 mb-4 text-base leading-relaxed">{!! nl2br(e($row->isi)) !!}</p>

                    <div class="grid md:grid-cols-2 text-base text-gray-600 gap-2 mb-4">
                        <p><strong class="text-teal-600">Lokasi:</strong> {{ $row->lokasi }}</p>
                        <p><strong class="text-teal-600">Instansi:</strong> {{ $row->nama_instansi }}</p>
                        <p><strong class="text-teal-600">Kategori:</strong> {{ $row->kategori }}</p>
                        <p><strong class="text-teal-600">Privasi:</strong> {{ $row->privasi }}</p>
                        @if ($row->lampiran)
    <p><strong class="text-teal-600">Lampiran:</strong>
        <a href="javascript:void(0);" onclick="bukaModal('{{ asset('storage/' . $row->lampiran) }}')" class="text-blue-500 hover:underline font-medium">Lihat 📎</a>
    </p>
@endif

                    </div>

                    @if ($isActiveDonasi)
                        <div class="mt-4">
                            {{-- @if (session()->has('id_user'))
                                <a href="{{ url('form_donasi?id_laporan=' . $row->id_laporan) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                    🎗️ Donasi Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                    🔒 Login untuk Donasi
                                </a>
                            @endif --}}
                            @auth
                            <a href="{{ route('form_donasi', ['id_laporan' => $row->id_laporan]) }}" class="btn-donasi bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
                                Donasi Sekarang sebagai {{ Auth::user()->username }}
                            </a>
                            @else
                            <a href="{{ url('/login') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 btn-donasi">🔒 Silakan login untuk donasi</a>
                            @endauth
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-lg">Belum ada laporan publik yang masuk.</p>
    @endif
</section>
<!-- Modal Lampiran -->
<div id="lampiranModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-2xl w-full relative">
        <button onclick="tutupModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        <div id="lampiranContent" class="text-center">
            <!-- Isi lampiran akan dimuat di sini -->
        </div>
    </div>
</div>

<script>
function bukaModal(url) {
    const modal = document.getElementById('lampiranModal');
    const content = document.getElementById('lampiranContent');

    if (url.match(/\.(jpeg|jpg|png|gif)$/i)) {
        content.innerHTML = `<img src="${url}" alt="Lampiran" class="mx-auto max-h-[500px] rounded">`;
    } else if (url.match(/\.pdf$/i)) {
        content.innerHTML = `<iframe src="${url}" class="w-full h-[500px]" frameborder="0"></iframe>`;
    } else {
        content.innerHTML = `<p class="text-red-600">Format file tidak didukung.</p>`;
    }

    modal.classList.remove('hidden');
}

function tutupModal() {
    document.getElementById('lampiranModal').classList.add('hidden');
    document.getElementById('lampiranContent').innerHTML = ''; // Kosongkan isi
}
</script>

</body>
</html>
{{-- <pre>
    {{ print_r($laporans, true) }}
</pre> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Lihat laporan saya</title>
</head>
<body>
    @include('components.navbar')

    <div class="relative w-full h-[275px] overflow-hidden">
        

        <section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex" style="background-image: url('{{ asset('assets/bg about.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative px-10 flex items-center gap-4">
                <img src="{{ asset('profile-pic.jpg') }}" alt="Profile Picture" class="w-24 h-24 rounded-full border-2 border-white">
                <h1 class="text-3xl font-bold text-white">Profil</h1>
            </div>
        </section>
    </div>
    
    <div class="container flex px-4 md:px-8 py-5">
        <main class="w-full bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Daftar Laporan Saya</h2>
            <div class="space-y-4">
                @foreach ($laporans as $laporan)
                    <div class="bg-white shadow-md rounded-lg p-4 w-full border-l-4
                        @switch($laporan->status)
                            @case('Pending') border-gray-500 @break
                            @case('Selesai') border-green-500 @break
                            @case('Diproses') border-yellow-500 @break
                            @case('Batal') border-red-500 @break
                        @endswitch">
                        
                        <!-- Judul & Tanggal -->
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-800">{{ $laporan->judul }}</h3>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</span>
                        </div>

                        <!-- Isi -->
                        <p class="text-gray-700 mb-3">{{ nl2br(e($laporan->isi)) }}</p>

                        <!-- Info tambahan -->
                        <div class="grid md:grid-cols-2 gap-2 text-sm text-gray-600 mb-3">
                            <div><strong>Lokasi:</strong> {{ $laporan->lokasi }}</div>
                            <div><strong>Instansi:</strong> {{ $laporan->nama_instansi }}</div>
                            <div><strong>Kategori:</strong> {{ $laporan->kategori }}</div>
                            <div><strong>Privasi:</strong> {{ $laporan->privasi }}</div>
                            <div><strong>Lampiran:</strong>
                                @if ($laporan->lampiran)
                                <a href="javascript:void(0);" onclick="bukaModal('{{ asset('storage/' . $laporan->lampiran) }}')" class="text-blue-500 hover:underline font-medium">Lihat Gambar 📎</a>
                                    </a>
                                    @else
    <span class="text-gray-500">Tidak ada lampiran</span>
@endif

                            </div>
                        </div>

                        <!-- Status & Aksi -->
                        <div class="flex justify-between items-center">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @switch($laporan->status)
                                    @case('Pending') bg-gray-100 text-gray-700 @break
                                    @case('Selesai') bg-green-100 text-green-700 @break
                                    @case('Diproses') bg-yellow-100 text-yellow-700 @break
                                    @case('Batal') bg-red-100 text-red-700 @break
                                @endswitch">
                                Status: {{ $laporan->status }}
                            </span>

                            @if ($laporan->status === 'Pending')
                                <form id="delete-form-{{ $laporan->id_laporan }}" action="{{ route('lapor.delete', $laporan->id_laporan) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button
                                onclick="confirmDelete({{ $laporan->id_laporan }})"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-1 px-3 rounded transition">
                                Tarik laporan
                            </button>

                            @endif
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </main>
    </div>
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
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Tarik laporan?',
            text: "Laporan yang ditarik tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, tarik saja!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

</body>
</html>
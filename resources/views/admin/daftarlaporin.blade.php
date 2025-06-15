<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @include('components.navbaradmin')
    <title>Daftar Laporin</title>
</head>
<body>
    <form action="{{ route('admin.ubahstatuslaporan') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')">
    @csrf

    <div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
        <h2 class="text-3xl font-bold text-orange-700 mb-6">Daftar Laporan</h2>

        <div class="overflow-x-auto w-full bg-white shadow-lg">
            <table class="w-full min-w-full text-sm text-left border border-orange-700">
                <thead class="bg-orange-700 text-white text-base">
                    <tr>
                        <th class="px-4 py-4">ID Laporan</th>
                        <th class="px py-4">User</th>
                        
                        <th class="px-4 py-4">Judul</th>
                        <th class="px-4 py-4">Isi</th>
                        <th class="px-4 py-4">Tanggal</th>
                        <th class="px-4 py-4">Lokasi</th>
                        <th class="px-4 py-4">Instansi</th>
                        <th class="px-4 py-4">Kategori</th>
                        <th class="px-4 py-4">Lampiran</th>
                        <th class="px-4 py-4">Privasi</th>
                        <th class="px-4 py-4">Status</th>
                    </tr>
                </thead>
                <tbody id="laporanTableBody" class="bg-white divide-y divide-orange-200">
                    @foreach ($laporan as $data)
                        <tr class="hover:bg-orange-100 transition-all">
                            <td class="px-4 py-4">{{ $data->id_laporan }}</td>

                            <td class="px-4 py-4">{{ $data->privasi === 'Publik' ? $data->username : '-' }}</td>
                            <td class="px-4 py-4">{{ $data->judul }}</td>
                            <td class="px-4 py-4 break-words whitespace-normal">{{ $data->isi }}</td>
                            <td class="px-4 py-4">{{ $data->tanggal }}</td>
                            <td class="px-4 py-4">{{ $data->lokasi }}</td>
                            <td class="px-4 py-4">{{ $data->nama_instansi }}</td>
                            <td class="px-4 py-4">{{ $data->kategori }}</td>
                            <td class="px-4 py-4">
                                @if (!empty($data->lampiran))
                                <a href="javascript:void(0);" onclick="bukaModal('{{ asset('storage/' . $data->lampiran) }}')" class="text-blue-700 hover:underline font-medium">Lihat 📎</a>
                                @else
                                <span class="text-gray-500">Tidak ada lampiran</span>
                                @endif
                            </td>

                            <td class="px-4 py-4">
                                {!! $data->privasi == 'Publik' 
                                    ? '<span class="text-green-600 font-semibold">Publik</span>' 
                                    : '<span class="text-red-600 font-semibold">Anonymous</span>' !!}
                            </td>
                            <td class="px-2 py-2">
                                <select name="status[{{ $data->id_laporan }}]" class="status-dropdown text-sm w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                    <option value="Pending" @if($data->status == 'Pending') selected @endif>Pending</option>
                                    <option value="Diproses" @if($data->status == 'Diproses') selected @endif>Diproses</option>
                                    <option value="Selesai" @if($data->status == 'Selesai') selected @endif>Selesai</option>
                                    <option value="Batal" @if($data->status == 'Batal') selected @endif>Batal</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-full mt-5">
            <div id="button_simpan" class="flex mb-4">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-l focus:outline-none hover:bg-orange-700">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
                @if(session('status') == 'success')
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        Status laporan berhasil diperbarui!
    </div>
@elseif(session('status') == 'error')
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        Terjadi kesalahan saat memperbarui status laporan.
    </div>
@endif
            </div>
        </div>
    </div>
</form>
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
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
                        <th class="px-4 py-4">ID</th>
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

                            <td class="px-4 py-4">{{ $data->privasi == 'publik' ? $data->username : '-' }}</td>
                            <td class="px-4 py-4">{{ $data->judul }}</td>
                            <td class="px-4 py-4 break-words whitespace-normal">{{ $data->isi }}</td>
                            <td class="px-4 py-4">{{ $data->tanggal }}</td>
                            <td class="px-4 py-4">{{ $data->lokasi }}</td>
                            <td class="px-4 py-4">{{ $data->nama_instansi }}</td>
                            <td class="px-4 py-4">{{ $data->kategori }}</td>
                            <td class="px-4 py-4">
                                @if (!empty($data->lampiran))
                                    <a href="{{ url('lihat_lampiran.php?id=' . $data->id_laporan) }}" target="_blank" class="text-blue-700 underline">Lihat Lampiran</a>
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
</body>
</html>
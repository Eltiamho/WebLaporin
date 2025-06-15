<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    @include('components.navbar')
    <main class="flex-grow px-4 mt-20">
    <h1 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mt-10 mb-6">Riwayat Donasi</h1>

    <div class="w-full max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-md overflow-x-auto">
        <table id="donasiTable" class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr class="text-center">
                    <th class="py-3">No</th>
                    <th class="py-3">Nama Donatur</th>
                    <th class="py-3">Judul Laporan</th>
                    <th class="py-3">Nominal</th>
                    <th class="py-3">Pesan</th>
                    <th class="py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="text-center text-gray-600">
                @forelse ($donasi as $no => $row)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">{{ $no + 1 }}</td>
                        <td class="py-3 font-semibold">{{ $row->nama }}</td>
                        <td class="py-3">{{ $row->judul }}</td>
                        <td class="py-3">
                            <span class="inline-block bg-green-100 text-green-800 text-xs sm:text-sm px-2 py-1 rounded">
                                Rp {{ number_format($row->jumlah, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-3 italic">{{ $row->pesan }}</td>
                        <td class="py-3">{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">Belum ada donasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
            <a href="{{ route('lapor') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition text-center">
                Donasi Lagi
            </a>
            <button onclick="generatePDF()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                Export PDF
            </button>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
<script>
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Riwayat Donasi", 14, 15);
        doc.autoTable({
            html: '#donasiTable',
            startY: 20,
            styles: { fontSize: 10 },
            headStyles: { fillColor: [22, 160, 133] }
        });

        doc.save("riwayat_donasi.pdf");
    }
</script>
</body>
</html>
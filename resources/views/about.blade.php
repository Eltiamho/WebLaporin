<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>About Lapor.In</title>
</head>
<body>
    @include('components.navbar')
    <!-- Hero Section -->
<section class="relative bg-cover bg-center text-white py-10 mt-16 text-center flex items-center justify-center" style="background-image: url('{{ asset('Assets/2.png') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-10"></div>
    <div class="relative z-10">
        <h1 class="text-3xl font-bold">Apa itu Lapor.in?</h1>
    </div>
</section>

<!-- About Content -->
<section class="max-w-6xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold">Lapor.in</h2>
            <p class="text-gray-600 mt-4">Pengelolaan pengaduan terkait berbagai permasalahan di masyarakat, seperti ketidakadilan pemerintahan, fasilitas umum yang tidak layak, dan kejadian bencana alam, masih belum terintegrasi dengan baik. Setiap instansi atau pihak berwenang sering kali menangani aduan secara parsial dan tidak terkoordinasi, yang dapat menyebabkan duplikasi penanganan atau bahkan pengabaian laporan dengan alasan di luar kewenangan. Akibatnya, banyak permasalahan yang tidak terselesaikan secara efektif.

    <div id="moreText" class="hidden mt-2">
                    <p class="text-gray-600">Lapor.in dibangun dengan prinsip “no wrong door policy”, yang menjamin bahwa setiap laporan yang masuk akan diproses dan diteruskan kepada pihak yang berwenang menangani permasalahan tersebut. Tujuan utama dari sistem ini adalah:

        <ol class="text-gray-600 m-3" type="1">
            <li>1. Mempermudah masyarakat dalam menyampaikan pengaduan secara cepat, tepat, dan terkoordinasi.</li>
                    <li>2. Memberikan akses transparan bagi masyarakat untuk berpartisipasi dalam melaporkan permasalahan di lingkungan mereka.</li>
                    <li>3. Meningkatkan efektivitas dalam penyelesaian aduan dengan sistem yang responsif dan terintegrasi.
                    </li>
        </ol>
        <p class="text-gray-600 mt-2">Dengan adanya Lapor.in, diharapkan setiap masalah yang dilaporkan oleh masyarakat dapat segera mendapatkan tanggapan dan penyelesaian yang tepat, sehingga tercipta lingkungan yang lebih baik, adil, dan nyaman bagi semua.</p>
</p>

        <div class="p-6 w-full max-w-3xl mx-auto">
            <h2 class="text-xl font-bold text-center mb-4">Tren Jumlah Laporan 3 Bulan Terakhir</h2>
            <div class="relative flex justify-center items-center">
                <div class="w-full md:w-4/5 lg:w-3/4">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <button id="readMoreBtn" class="mt-6 px-6 py-3 border-none bg-orange-700 text-white rounded-lg hover:bg-orange-600">Lebih banyak</button>

    <script>
        document.getElementById("readMoreBtn").addEventListener("click", function() {
            var moreText = document.getElementById("moreText");
            if (moreText.classList.contains("hidden")) {
                moreText.classList.remove("hidden");
                this.textContent = "Lebih sedikit";
            } else {
                moreText.classList.add("hidden");
                this.textContent = "Lebih banyak";
            }
        });
    </script>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulananCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(bulananCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Laporan',
                data: {!! json_encode($data) !!},
                borderColor: 'rgba(12, 119, 12, 1)',
                backgroundColor: 'rgba(12, 119, 12, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

<!-- Why Choose Us -->
<section class="bg-gray-100 py-16 mt-10">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-2xl font-bold mb-6">Mengapa harus Lapor.in?</h2>
        <p class="text-gray-700 mb-10">Kami menyediakan platform yang transparan, cepat, dan mudah digunakan untuk melaporkan berbagai kejadian penting, memastikan setiap laporan mendapat perhatian dari pihak yang berwenang</p>
        <div class="grid gap-6 md:grid-cols-3 text-left">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Pelaporan Cepat</h3>
                <p class="text-gray-600 text-sm">Langsung lapor dengan cepat tanpa proses rumit.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Distribusi Tepat Sasaran</h3>
                <p class="text-gray-600 text-sm">Laporan langsung diteruskan ke pihak berwenang.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <h3 class="font-semibold text-lg mb-2 text-orange-700">Pantauan dan Tindak Lanjut</h3>
                <p class="text-gray-600 text-sm">Tiap laporan dimonitor dan ditindaklanjuti.</p>
            </div>
        </div>
    </div>
</section>
    @include('components.footer')

</body>
</html>
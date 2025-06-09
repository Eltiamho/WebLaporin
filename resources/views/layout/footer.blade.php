<!-- resources/views/layouts/footer.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>login</title>
</head>
<body>
    <footer class="bg-gray-900 text-white py-10 mt-10">
        <div class="container mx-auto text-center">
            <h2 class="text-xl font-semibold">INSTANSI TERHUBUNG</h2>
            <div class="flex justify-center gap-6 mt-6 flex-wrap">
                <a href="https://www.menpan.go.id/" target="_blank">
                    <img src="{{ asset('Assets/Logo_PANRB_Default.png') }}" alt="PANRB" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
                <a href="https://www.komdigi.id/" target="_blank">
                    <img src="{{ asset('Assets/KOMDIGI Logo 2024.webp') }}" alt="Komdigi" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
                <a href="https://www.ombudsman.go.id/" target="_blank">
                    <img src="{{ asset('Assets/ombudsman.png') }}" alt="Ombudsman RI" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
            </div>
            <div class="mt-8">
                <ul class="flex justify-center gap-4 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-green-600">Privacy</a></li>
                    <li><a href="#" class="hover:text-green-600">Ketentuan Layanan</a></li>
                    <li><a href="#" class="hover:text-green-600">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-green-600">Hubungi Kami</a></li>
                </ul>
                <p class="text-xs text-gray-500 mt-4">&copy; 2025 Kantor Staf Presiden. Hak cipta dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>
    
</body>
</html>


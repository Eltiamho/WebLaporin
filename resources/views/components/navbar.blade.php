
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<nav id="navbar" class="fixed top-0 left-0 w-full bg-gray-800 shadow-md p-4 flex justify-between items-center z-50 transition-all duration-300">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('Assets/logo_laporin2.png') }}" alt="Logo Lapor.in" class="h-8 w-10 object-contain">
        <h2 class="text-white text-lg font-bold">Lapor.In</h2>
    </div>

    <!-- Navigasi Desktop -->
    <ul class="hidden md:flex space-x-6">
    <li><a href="{{ url('/') }}" class="text-white font-semibold hover:text-orange-400">BERANDA</a></li>
    <li><a href="{{ url('/about') }}" class="text-white font-semibold hover:text-orange-400">TENTANG LAPOR.IN</a></li>
    <li><a href="{{ url('/lapor') }}" class="text-white font-semibold hover:text-orange-400">LAPOR</a></li>
    
    @auth
    <!-- Dropdown Profil -->
    <div class="relative">
        <button id="profile-toggle" class="text-white font-semibold hover:text-orange-400 flex items-center space-x-2">
            PROFIL<i class="fa-solid fa-caret-down px-1"></i>
        </button>
        <div id="profile-dropdown" class="hidden absolute top-12 right-4 w-48 border-2 border-gray-600 bg-white shadow-md rounded-md z-50">
            <a href="{{ url('/ubahprofil') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Ubah Profil</a>
            <a href="{{ url('/lihatlaporan') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Lihat Laporan Saya</a>
            <a href="{{ route('riwayat_donasi') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Riwayat Donasi</a>
            {{-- <a href="{{ url('/proseslogout') }}" class="block px-4 py-2 text-red-600 hover:bg-gray-200">Keluar</a> --}}
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">Keluar</button>
</form>
        </div>
    </div>
    @else
    <a href="{{ url('/login') }}" class="text-white font-semibold hover:text-orange-400">MASUK</a>
    <a href="{{ url('/register') }}" class="text-white font-semibold hover:text-orange-400">DAFTAR</a>
    @endauth
</ul>


    <!-- Navigasi Mobile -->
<div class="md:hidden flex items-center space-x-4">
    @auth
    <button id="profile-toggle-mobile" class="text-white font-semibold hover:text-orange-400 flex items-center space-x-2">
        PROFIL<i class="fa-solid fa-caret-down px-1"></i>
    </button>
    <div id="profile-dropdown-mobile" class="hidden absolute top-16 right-4 w-48 border-2 border-gray-600 bg-white shadow-md rounded-md z-50">
        <a href="{{ url('/ubahprofil') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Ubah Profil</a>
        <a href="{{ url('/lihatlaporan') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Lihat Laporan Saya</a>
        <a href="{{ url('/halaman_donasi') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Riwayat Donasi</a>
        {{-- <a href="{{ url('/proseslogout') }}" class="block px-4 py-2 text-red-600 hover:bg-gray-200">Keluar</a> --}}
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">Keluar</button>
</form>
    </div>
    @endauth

    <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none">
        ☰
    </button>
</div>

</nav>

<!-- Dropdown Menu Mobile -->
<div id="dropdown-menu" class="hidden fixed top-16 right-4 w-48 border-2 border-gray-600 bg-white shadow-md rounded-md z-50 md:hidden">
    <ul class="flex flex-col space-y-2 px-4 py-2">
        <li><a href="{{ url('/') }}" class="block text-gray-600 font-semibold hover:text-orange-400">BERANDA</a></li>
        <li><a href="{{ url('/about') }}" class="block text-gray-600 font-semibold hover:text-orange-400">TENTANG</a></li>
        <li><a href="{{ url('/lapor') }}" class="block text-gray-600 font-semibold hover:text-orange-400">LAPOR</a></li>
        @guest
        <li><a href="{{ url('/login') }}" class="block text-gray-600 font-semibold hover:text-orange-400">MASUK</a></li>
        <li><a href="{{ url('/register') }}" class="block text-gray-600 font-semibold hover:text-orange-400">DAFTAR</a></li>
        @endguest
    </ul>
</div>


<!-- Script Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let hamburgerMenu = document.getElementById("menu-toggle");
        let menuDropdown = document.getElementById("dropdown-menu");

        let profileToggle = document.getElementById("profile-toggle");
        let profileDropdown = document.getElementById("profile-dropdown");

        let profileToggleMobile = document.getElementById("profile-toggle-mobile");
        let profileDropdownMobile = document.getElementById("profile-dropdown-mobile");

        // Fungsi untuk menutup semua dropdown kecuali yang sedang diklik
        function closeAllDropdowns(except = null) {
            if (except !== menuDropdown) menuDropdown.classList.add("hidden");
            if (except !== profileDropdown && profileDropdown) profileDropdown.classList.add("hidden");
            if (except !== profileDropdownMobile && profileDropdownMobile) profileDropdownMobile.classList.add("hidden");
        }

        // Toggle dropdown menu utama (hamburger menu)
        hamburgerMenu.addEventListener("click", function (event) {
            event.stopPropagation();
            let isOpen = !menuDropdown.classList.contains("hidden");
            closeAllDropdowns(); // Tutup dropdown lain
            if (!isOpen) menuDropdown.classList.remove("hidden"); // Jika belum terbuka, buka dropdown
        });

        // Toggle dropdown profil desktop
        if (profileToggle) {
            profileToggle.addEventListener("click", function (event) {
                event.stopPropagation();
                let isOpen = !profileDropdown.classList.contains("hidden");
                closeAllDropdowns(); // Tutup dropdown lain
                if (!isOpen) profileDropdown.classList.remove("hidden");
            });
        }

        // Toggle dropdown profil mobile
        if (profileToggleMobile) {
            profileToggleMobile.addEventListener("click", function (event) {
                event.stopPropagation();
                let isOpen = !profileDropdownMobile.classList.contains("hidden");
                closeAllDropdowns(); // Tutup dropdown lain
                if (!isOpen) profileDropdownMobile.classList.remove("hidden");
            });
        }

        // Tutup dropdown jika klik di luar
        document.addEventListener("click", function () {
            closeAllDropdowns();
        });
    });
</script>
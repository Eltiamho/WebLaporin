@php
// use Illuminate\\Support\\Facades\\Session;
//     use Illuminate\\Support\\Facades\\DB;

    $id_admin = Session::get('id_admin');
    $admin = DB::table('admin')->where('id_admin', $id_admin)->first();
    $nama_admin = session('nama') ?? 'Admin';
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white p-5 transition-transform transform -translate-x-64 md:translate-x-0 shadow-lg flex flex-col justify-between z-50">
    <div>
        <h2 class="text-xl font-bold mb-6 mt-10 text-white">
            Admin <span class="text-orange-500">{{ $nama_admin }}</span>
        </h2>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-chart-simple"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profiluser') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-users"></i> Kelola User
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profiladmin') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-user"></i> Kelola Admin
                </a>
            </li>
            <li>
                <a href="{{ route('admin.daftarlaporin') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-pen-to-square"></i> Daftar Laporin
                </a>
            </li>
            <li>
                <a href="{{ route('admin.daftarinstansi') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:text-orange-400 hover:bg-gray-700 transition-all">
                    <i class="fa-solid fa-building"></i> Daftar Instansi
                </a>
            </li>
        </ul>
    </div>

    <div class="mb-4">
        <a href="{{ route('logout') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-red-600 hover:bg-red-700 transition-all text-white">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>

<button id="menu-btn" class="fixed top-4 left-4 p-2 bg-gray-800 text-white rounded z-50 md:hidden transition-all ">☰</button>

<script>
    const menuBtn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");

    menuBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-64");
    });
</script>

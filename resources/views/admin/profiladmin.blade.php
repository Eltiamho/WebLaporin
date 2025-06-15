<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-100">

@include('components.navbaradmin')

<div id="content" class="flex-1 p-6 transition-all md:ml-64 flex flex-col justify-center items-center">
    <h2 class="text-3xl font-bold text-black mb-6">Daftar Admin</h2>

    <div class="w-full max-w-5xl">
        <div class="flex justify-end mb-4">
            <button onclick="openAddModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-l hover:bg-green-700">
                Tambah <i class="fa-solid fa-plus"></i> 
            </button>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg">
            <table class="w-full text-sm text-left border border-black">
                <thead class="bg-black text-white text-base">
                    <tr>
                        <th class="px-6 py-4">User ID</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-20 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-black">
                    @foreach ($admins as $admin)
                        <tr id="admin-row-{{ $admin->id_admin }}" data-id="{{ $admin->id_admin }}" data-nama="{{ $admin->nama }}" data-email="{{ $admin->email }}" class="hover:bg-gray-100 transition-all">
                            <td class="px-6 py-4">{{ $admin->id_admin }}</td>
                            <td class="px-6 py-4">{{ $admin->nama }}</td>
                            <td class="px-6 py-4">{{ $admin->email }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <button 
                                    onclick="openEditModal({{ $admin->id_admin }})" 
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-all">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </button>
                                <button 
                                    type="button"
                                    onclick="openDeleteModal('{{ $admin->id_admin }}', '{{ $admin->nama }}')"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-96 relative">
        <h2 class="text-xl font-bold mb-4">Edit Admin</h2>

        @if (session('edit_error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
            {{ session('edit_error') }}
        </div>
        @endif

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id_admin" name="id_admin" value="{{ old('id_admin') }}">

            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" id="edit_nama" name="nama" value="{{ old('nama') }}" class="w-full px-3 py-2 border rounded mb-3" required>
            @error('nama')
                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror

            <label class="block mb-1 font-semibold">Email (tidak dapat diubah)</label>
            <input type="text" id="edit_email" class="w-full px-3 py-2 border rounded mb-3 bg-gray-200" readonly>

            <label class="block mb-1 font-semibold">Password Lama (verifikasi)</label>
            <div class="relative">
                <input type="password" id="old_password" name="old_password" class="w-full px-3 py-2 border rounded mb-3 pr-10">
                <span onclick="togglePassword('old_password')" class="absolute right-3 top-3 cursor-pointer text-gray-500">
                    <i class="fa-regular fa-eye" id="toggle_old_password"></i>
                </span>
                @error('old_password')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                
            </div>            

            <label class="block mb-1 font-semibold">Password Baru (opsional)</label>
            <div class="relative">
                <input type="password" id="edit_password" name="password" class="w-full px-3 py-2 border rounded mb-3 pr-10">
                @error('password')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <span onclick="togglePassword('edit_password')" class="absolute right-3 top-3 cursor-pointer text-gray-500">
                    <i class="fa-regular fa-eye" id="toggle_edit_password"></i>
                </span>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>        
    </div>
</div>

<!-- Modal Tambah Admin -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center {{ session('add_error') ? '' : 'hidden' }} z-50">
    <div class="bg-white p-6 rounded-lg w-96 relative">
        <h2 class="text-xl font-bold mb-4">Tambah Admin Baru</h2>

        {{-- Tampilkan error jika ada --}}
        @if (session('add_error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
                {{ session('add_error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-3 py-2 border rounded mb-3" required>

            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded mb-3" required>

            <label class="block mb-1 font-semibold">Password</label>
            <div class="relative">
                <input type="password" id="add_password" name="password" class="w-full px-3 py-2 border rounded mb-3 pr-10" required>
                <span onclick="togglePassword('add_password')" class="absolute right-3 top-3 cursor-pointer text-gray-500">
                    <i class="fa-regular fa-eye" id="toggle_add_password"></i>
                </span>
            </div>

            <label class="block mb-1 font-semibold">Konfirmasi Password</label>
            <div class="relative">
                <input type="password" id="add_password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded mb-3 pr-10" required>
                <span onclick="togglePassword('add_password_confirmation')" class="absolute right-3 top-3 cursor-pointer text-gray-500">
                    <i class="fa-regular fa-eye" id="toggle_add_password_confirmation"></i>
                </span>
            </div>

            <label class="block mb-1 font-semibold">Password Anda (verifikasi)</label>
            <div class="relative">
                <input type="password" id="admin_verification" name="admin_verification" class="w-full px-3 py-2 border rounded mb-3 pr-10" required>
                <span onclick="togglePassword('admin_verification')" class="absolute right-3 top-3 cursor-pointer text-gray-500">
                    <i class="fa-regular fa-eye" id="toggle_admin_verification"></i>
                </span>
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Delete --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus Admin</h2>
        <form method="POST" action="{{ route('admin.hapusAdminDenganPassword') }}" class="bg-white p-4 rounded shadow-md w-full">
            @csrf
            <input type="hidden" name="id_admin" id="delete_id_admin">
            <p class="mb-4">Masukkan password admin <span id="delete_nama_admin" class="font-semibold"></span> untuk menghapusnya.</p>

            <div class="mb-4">
                <label for="delete_password" class="block text-sm font-medium">Password Admin yang Akan Dihapus</label>
                <div class="relative">
                    <input type="password" name="password" id="delete_password" class="w-full border rounded p-2">
                    <i class="fa fa-eye absolute right-3 top-3 cursor-pointer" onclick="togglePassword('delete_password')"></i>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>


<!-- Script -->
<script>
    function openEditModal(id) {
        const row = document.getElementById(`admin-row-${id}`);
        const nama = row.getAttribute('data-nama');
        const email = row.getAttribute('data-email');

        document.getElementById('edit_id_admin').value = id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_password').value = '';
        document.getElementById('old_password').value = '';

        const actionUrl = '{{ route("admin.update", ":id") }}'.replace(':id', id);
        document.getElementById('editForm').action = actionUrl;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById('toggle_' + fieldId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    function openDeleteModal(id, nama) {
        document.getElementById('delete_id_admin').value = id;
        document.getElementById('delete_nama_admin').textContent = nama;
        document.getElementById('delete_password').value = '';
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }


    document.addEventListener('DOMContentLoaded', () => {
        // Buka modal jika validasi gagal saat tambah admin
        @if ($errors->any() && old('email') && !old('edit_id'))
            openAddModal();
        @endif

        // Buka modal jika validasi gagal saat edit admin
        @php $editId = session('edit_id') ?? old('id_admin'); @endphp
        @if (($errors->any() || session('edit_error')) && $editId)
            openEditModal({{ $editId }});
        @endif
    });
</script>


</body>
</html>

<form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="nama" class="block font-medium">Nama</label>
        <input type="text" name="nama" id="nama" required class="w-full border px-3 py-2 rounded">
    </div>

    <div>
        <label for="email" class="block font-medium">Email</label>
        <input type="email" name="email" id="email" required class="w-full border px-3 py-2 rounded">
    </div>

    <div>
        <label for="password" class="block font-medium">Password</label>
        <input type="password" name="password" id="password" required class="w-full border px-3 py-2 rounded">
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Tambah Admin
    </button>
</form>

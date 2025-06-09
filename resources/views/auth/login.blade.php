<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>LOGIN</title>
</head>
<body>
<div class="flex justify-center items-center h-screen">
    <div class="w-96 p-6 shadow-lg bg-white rounded-md">
        <h1 class="text-3xl block text-center font-semibold"><i class="fa-solid fa-user px-2"></i>Masuk</h1>
        <hr class="mt-3">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mt-3">
                <label for="email" class="block text-base mb-2">Email</label>
                <input type="email" name="email" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Email..." required />
            </div>
            <div class="mt-3">
                <label for="password" class="block text-base mb-2">Password</label>
                <input type="password" name="password" class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600" placeholder="Masukkan Password..." required />
            </div>

            <div class="mt-3 text-gray-500">
                <input type="checkbox" onclick="togglePassword()"> Show password
            </div>

            <div class="mt-5">
                @if($errors->has('login'))
                    <p style="color: red;">{{ $errors->first('login') }}</p>
                @endif
                <button type="submit" class="border-2 bg-orange-600 hover:bg-orange-700 text-white py-1 w-full rounded-md font-semibold"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
            </div>

            <div class="mt-2">
                <a href="javascript:void(0);" onclick="forgotpass()" class="underline italic font-semibold cursor-pointer">Lupa password?</a>
            </div>
        </form>
    </div>
</div>

<!-- Forgot Password Form -->
<div id="lupapassform" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4 text-red-600">Ubah Password</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold">Email</label>
                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold">Password baru</label>
                <input type="password" name="pass_new" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold">Konfirmasi password</label>
                <input type="password" name="pass_conf" class="w-full p-2 border border-gray-300 rounded" required>
                <input type="checkbox" onclick="togglePassword2()"> Show password
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeForm()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500">Simpan</button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword2() {
            var pass1 = document.getElementById("pass1");
            var pass2 = document.getElementById("pass2");

            if (pass1.type === "password" && pass2.type === "password") {
                pass1.type = "text";
                pass2.type = "text";
            } else {
                pass1.type = "password";
                pass2.type = "password";
            }
        }
    </script>
</div>

</body>
</html>
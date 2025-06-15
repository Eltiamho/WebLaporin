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
    @include('components.navbar')

    <div class="flex justify-center items-center h-screen">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold">
                <i class="fa-solid fa-user px-2"></i>Masuk
            </h1>
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

                <div class="mt-5">
                    @if($errors->has('login'))
                        <p class="text-red-600 text-sm">{{ $errors->first('login') }}</p>
                    @endif

                    <button type="submit" class="border-2 bg-orange-600 hover:bg-orange-700 text-white py-1 w-full rounded-md font-semibold">
                        <i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login
                    </button>
                </div>

                <div class="mt-2">
                    <p>Route ke lupa password: {{ route('lupapassword.form') }}</p>
                    <a href="{{ route('lupapassword.form') }}" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

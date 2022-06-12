<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chipo') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="flex justify-center mt-6">
        <div class="py-5 px-8 border rounded-lg shadow-md  w-96">

            <div class="flex items-center mb-4">
                <img src="https://i.ibb.co/fnhFTHK/Chipo-Logo-Circle.png" class="w-10 h-10" />
                <div class="text-xl font-bold text-primary ml-2">Bubur Ayam Koko Celamitan</div>
            </div>

            <hr />

            <div class="mb-2">
                <div class="text-gray-900 font-extrabold text-lg mt-5">Hi Artha,</div>
                <div class="text-gray-500 font-semibold text-lg mb-4">Terimakasih telah melakukan registrasi</div>
                <div class="text-gray-500 font-semibold text-lg mb-4">Sekarang Anda dapat melakukan reservasi tempat
                </div>
                <a href="#"
                    class="flex items-center justify-center text-white bg-blue-700 font-medium rounded-lg text-sm px-5 py-2">
                    Login Sekarang
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path
                                d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </span>
                </a>

            </div>
        </div>
    </div>
</body>

</html>

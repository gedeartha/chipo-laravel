<x-guest-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-4">
        <div class="hidden lg:block relative h-screen p-5">
            <img class="w-full h-full rounded-xl" src="/img/register-image.png" alt="Chipo" />
        </div>
        <div class="flex flex-col items-center justify-center h-screen">
            <div class="mb-10">
                <a href="/">
                    <img class="h-10" src="/img/chipo-logo.svg" alt="Chipo" />
                </a>
            </div>
            <div class="text-center mb-5 w-96">
                <div class="text-2xl font-bold text-primary mb-2">Buat akun</div>
                <div class="text-gray-400">Pendaftaran sangat mudah hanya dengan mengisi formulir dibawah ini</div>
            </div>

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                    role="alert">
                    <span class="font-medium">Failed!</span> {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="website-admin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama</label>
                    <x-input id="name" class="block mt-1 w-96 capitalize" type="text" name="name" required autofocus />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="website-admin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <x-input id="email" class="block mt-1 w-96 lowercase" type="email" name="email" required
                        autofocus />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password" value="Password" />
                    <x-input id="password" class="block mt-1 w-96" type="password" name="password" required autofocus />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <x-label for="password_confirm" value="Konfirmasi Password" />
                    <x-input id="password_confirm" class="block mt-1 w-96" type="password" name="password_confirm"
                        required autofocus />
                </div>

                <div class="flex items-center justify-end mt-5">
                    <x-button>
                        Daftar Sekarang
                    </x-button>
                </div>
            </form>

            <div class="mt-16">
                Sudah punya Akun? <a href="/login" class="text-blue-600">Masuk</a>
            </div>
        </div>
    </div>
</x-guest-layout>

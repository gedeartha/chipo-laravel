<x-guest-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-4">
        <div class="hidden lg:block relative h-screen p-5">
            <img class="w-full h-full rounded-xl" src="/img/forgot-password-image.png" alt="Chipo" />
        </div>
        <div class="flex flex-col items-center justify-center h-screen mx-auto">
            <div class="mb-10">
                <a href="/">
                    <img class="h-10" src="/img/chipo-logo.svg" alt="Chipo" />
                </a>
            </div>
            <div class="text-center mb-5">
                <div class="text-2xl font-bold text-primary mb-2">Lupa Password</div>
                <div class="text-gray-400">Masukkan email Anda yang telah terdaftar</div>
            </div>

            <div class="mb-3">

                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                        role="alert">
                        <span class="font-medium">Gagal!</span> {{ session('error') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('forgot-password.store') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-96 lowercase" type="email" name="email" required
                        autofocus />
                </div>

                <div class="flex items-center justify-end mt-5">
                    <x-button>
                        Submit
                    </x-button>
                </div>
            </form>

            <div class="mt-16">
                Tidak punya Akun? <a href="/register" class="text-blue-600">Buat sekarang</a>
            </div>
        </div>
    </div>
</x-guest-layout>

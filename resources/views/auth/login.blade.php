<x-guest-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-4">
        <div class="hidden lg:block relative h-screen p-5">
            <img class="w-full h-full rounded-xl" src="/img/login-image.png" alt="Chipo" />
        </div>
        <div class="flex flex-col items-center justify-center h-screen mx-auto">
            <div class="mb-10">
                <a href="/">
                    <img class="h-10" src="/img/chipo-logo.svg" alt="Chipo" />
                </a>
            </div>
            <div class="text-center mb-5">
                <div class="text-2xl font-bold text-primary mb-2">Welcome back</div>
                <div class="text-gray-400">Masuk dengan akun yang telah didaftarkan</div>
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
                        <span class="font-medium">Login Gagal!</span> {{ session('error') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="website-admin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <div class="flex">
                        <input type="text" id="email" name="email"
                            class="rounded-none lowercase rounded-l-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-r-md border border-l-0 border-gray-300">
                            @chipo.com
                        </span>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password" value="Password" />
                    <x-input id="password" class="block mt-1 w-96" type="password" name="password" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-5">
                    <x-button>
                        Masuk
                    </x-button>
                </div>
            </form>

            <div class="mt-16">
                Tidak punya Akun? <a href="/register" class="text-blue-600">Buat sekarang</a>
            </div>
        </div>
    </div>
</x-guest-layout>

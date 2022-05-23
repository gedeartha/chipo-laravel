<x-guest-layout>
    <div class="h-screen w-screen flex justify-center items-center bg-secondary">
        <div class="shadow-md bg-white rounded-xl p-5">
            <div class="flex flex-col items-center justify-center">
                <div class="mb-2">
                    <a href="/">
                        <img class="h-10" src="/img/chipo-logo.svg" alt="Chipo" />
                    </a>
                </div>
                <div class="text-center mb-3">
                    <div class="text-2xl font-bold text-primary mb-2">Admin</div>
                </div>

                <div class="mb-2">

                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                            role="alert">
                            <span class="font-medium">Failed!</span> {{ session('error') }}
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}">
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
                        <x-input id="password" class="block mt-1 w-96" type="password" name="password" required
                            autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        <x-button>
                            Masuk
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

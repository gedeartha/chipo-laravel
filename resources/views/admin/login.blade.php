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

                <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <x-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-96" type="email" name="email" required autofocus />
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

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
                    <div class="text-2xl font-bold text-primary mb-2">Reset Password</div>
                </div>

                <div class="mb-3">
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                            role="alert">
                            <span class="font-medium">Error!</span> {{ session('error') }}
                        </div>
                    @endif
                </div>

                @if (!$token)
                    <div class="mb-2">
                        <div class="py-4 px-20 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                            role="alert">
                            <span class="font-medium">Error!</span> Tautan tidak valid.
                        </div>
                    </div>
                @else
                    <form method="POST" action="{{ route('reset-password.store') }}">
                        @csrf

                        <!-- ID User -->
                        <div class="mb-3 hidden">
                            <x-label for="user_id" value="User ID" />
                            <x-input id="user_id" class="block mt-1 w-96" type="text" name="user_id"
                                value="{{ $user_id }}" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <x-label for="password" value="Password" />
                            <x-input id="password" class="block mt-1 w-96" type="password" name="password" required
                                autofocus />
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-3">
                            <x-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-input id="password_confirmation" class="block mt-1 w-96" type="password"
                                name="password_confirmation" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-5">
                            <x-button>
                                Reset Password
                            </x-button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-guest-layout>

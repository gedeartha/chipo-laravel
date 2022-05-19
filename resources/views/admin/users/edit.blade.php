<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="grid grid-cols-12 gap-10">
                <div class="col-span-8">
                    <div class="shadow-md bg-white rounded-xl p-5">
                        <div class="font-extrabold text-3xl text-primary mb-4">Edit User</div>
                        <hr class="mb-4" />

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

                        <form method="POST" action="{{ $user->id }}/update" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <x-label for="name" value="Nama User" />
                                <x-input id="name" class="block mt-2 w-full" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" required autofocus />

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="website-admin"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <div class="flex">
                                    @php
                                        $emailGet = $user->email;
                                        $email = explode('@', $emailGet);
                                        
                                    @endphp
                                    <input type="text" id="email" name="email"
                                        class="rounded-none rounded-l-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                        value="{{ old('email', $email[0]) }}">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-r-md border border-l-0 border-gray-300">
                                        @chipo.com
                                    </span>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="mb-3">
                                <x-label for="table" value="Meja" />
                                <select id="table" name="table"
                                    class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required autofocus>
                                    <option>1</option>
                                    <option>2</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-5">
                                <x-button>
                                    Submit
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

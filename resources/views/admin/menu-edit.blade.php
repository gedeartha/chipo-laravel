<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="grid grid-cols-12 gap-10">
                <div class="col-span-8">
                    <div class="shadow-md bg-white rounded-xl p-5">
                        <div class="font-extrabold text-3xl text-primary mb-4">Edit Menu</div>
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

                        <form method="POST" action="{{ route('admin.menu-edit.update') }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <x-label for="name" value="Nama Menu" />
                                <x-input id="name" class="block mt-2 w-full" type="text" name="name"
                                    value="{{ old('name', $menu->name) }}" required autofocus />
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <x-label for="description" value="Deskripsi" />
                                <textarea rows="4" id="description" class="block mt-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    type="text" name="description" required
                                    autofocus>{{ old('name', $menu->description) }}</textarea>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <x-label for="price" value="Harga" class="mb-2" />
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                        Rp
                                    </span>
                                    <input type="number" id="price" name="price"
                                        class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                                        value="{{ old('name', $menu->price) }}">
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <x-label for="image" value="Foto" />
                                <input
                                    class="block mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-transparent"
                                    id="image" type="file" name="image">
                            </div>

                            <div class="flex items-center justify-end mt-5">
                                <x-button>
                                    Submit
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-span-4">
                    <div class="block">
                        <img class="h-full w-full rounded-2xl" src="{{ Storage::url('upload/') . $menu->image }}"
                            alt="Bubur Ayam" />
                    </div>
                    <div class="mt-4 mb-2">
                        <div class="font-extrabold text-3xl text-primary">
                            {{ $menu->name }}
                        </div>
                    </div>
                    <div class="font-semibold text-2xl text-primary mb-4">Rp
                        {{ number_format($menu->price, 0, ',', '.') }}</div>
                    <div class="-mt-2 text-md text-gray-500">{{ $menu->description }}</div>
                </div>
            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

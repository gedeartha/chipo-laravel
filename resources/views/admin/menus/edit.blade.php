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

                        <form action="{{ $menu->id }}/update" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <x-label for="name" value="Nama Menu" />
                                <x-input id="name" class="block mt-2 w-full" type="text" name="name"
                                    placeholder="Nama menu" value="{{ old('name', $menu->name) }}" required
                                    autofocus />

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <x-label for="description" value="Deskripsi" />
                                <textarea rows="4" id="description"
                                    class="block mt-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    type="text" name="description" placeholder="Masukkan deskripsi" required autofocus>{{ old('name', $menu->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <x-label for="price" value="Harga" />
                                <x-input id="price" class="block mt-2 w-full" type="number" name="price"
                                    placeholder="Masukkan harga" value="{{ old('price', $menu->price) }}" required
                                    autofocus />

                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <x-label for="image" value="Foto" />
                                <input
                                    class="block mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-transparent"
                                    id="image" type="file" name="image">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <x-label for="status" value="Status" />
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required autofocus>
                                    <option>Pilih Status
                                    </option>
                                    <option value="Tersedia" @if ($menu->status == 'Tersedia') selected @endif>
                                        Tersedia</option>
                                    <option value="Tidak Tersedia" @if ($menu->status == 'Tidak Tersedia') selected @endif>
                                        Tidak
                                        Tersedia
                                    </option>
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

                <div class="col-span-4">
                    <div class="block">
                        <img class="h-full w-full rounded-2xl" src="{{ Storage::url('upload/') . $menu->image }}"
                            alt="Telur Puyuh" />
                    </div>
                    <div class="flex justify-between mt-4 mb-2 space-x-2">
                        <div class="font-extrabold text-3xl text-primary">{{ $menu->name }}</div>

                        @if ($menu->status == 'Tersedia')
                            <span>
                                <div class="flex p-2 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                                    <svg class="inline flex-shrink-0 mr-1 w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <span class="font-medium">Tersedia</span>
                                    </div>
                                </div>
                            </span>
                        @else
                            <span>
                                <div class="flex p-2 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg"
                                    role="alert">
                                    <svg class="inline flex-shrink-0 mr-1 w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <span class="font-medium">Tidak Tersedia</span>
                                    </div>
                                </div>
                            </span>
                        @endif
                    </div>
                    <div class="font-semibold text-2xl text-primary mb-4">Rp
                        {{ number_format($menu->price, 0, ',', '.') }}
                    </div>
                    <div class="-mt-2 text-md text-gray-500">{{ $menu->description }}</div>

                    <div class="mt-4">
                        <form action="{{ $menu->id }}/delete" method="POST">
                            @csrf
                            @method('delete')
                            <x-button-delete>
                                Hapus
                            </x-button-delete>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

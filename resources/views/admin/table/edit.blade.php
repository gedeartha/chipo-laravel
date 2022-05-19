<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink p-10">

        <div class="grid grid-cols-12 gap-8">
            {{-- Content --}}
            <div class="col-span-9">
                <div class="flex justify-between">
                    <div class="font-extrabold text-3xl text-primary mb-4">Daftar Meja</div>
                </div>
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

                <div class="bg-white shadow-lg rounded-xl p-8">
                    <div class="flex justify-center items-center mb-5">
                        <div class="w-52">
                            <img class="w-full h-full" src="/img/reservation-stage.png" alt="Panggung" />
                            <div class="text-center -mt-2">Panggung</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        @foreach ($tables as $table)
                            <a href="{{ route('admin.table.edit', $table->table) }}">
                                @if ($table->table == $table_selected)
                                    <div
                                        class="border rounded-lg flex items-center justify-center h-20 bg-tertiary text-white">
                                    @elseif ($table->status == 'Tidak Tersedia')
                                        <div
                                            class="border rounded-lg flex items-center justify-center h-20 bg-gray-500 text-white">
                                        @else
                                            <div
                                                class="border rounded-lg flex items-center justify-center h-20 text-primary">
                                @endif
                                <div class="text-2xl font-bold">{{ $table->table }}</div>
                    </div>
                    </a>
                    @endforeach

                </div>

                <div class="grid grid-cols-3 mt-10">
                    <div class="flex space-x-4 justify-center">
                        <div class="border rounded-lg flex items-center justify-center w-6 h-6 bg-tertiary">
                        </div>
                        <div class="text-base font-bold">Terpilih</div>
                    </div>
                    <div class="flex space-x-4 justify-center">
                        <div class="border rounded-lg flex items-center justify-center w-6 h-6 bg-gray-500">
                        </div>
                        <div class="text-base font-bold">Tidak Tersedia</div>
                    </div>
                    <div class="flex space-x-4 justify-center">
                        <div class="border-2 rounded-lg flex items-center justify-center w-6 h-6 bg-white">
                        </div>
                        <div class="text-base font-bold">Tersedia</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white shadow-lg rounded-xl col-span-3 p-5 mt-18">
            <form action="{{ route('admin.table.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <hr class="mt-5 mb-2" />
                <div class="font-bold text-lg text-primary mb-2">Ubah Status</div>
                <hr class="mb-2" />

                <div class="mb-3">

                    <div class="flex flex-col mb-3">
                        <x-label for="status" value="No. Meja" />
                        <div class="font-bold text-base">{{ $table_selected }}</div>
                        <x-input id="table" class="hidden mt-2 w-full" type="text" name="table"
                            value="{{ $table_selected }}" />
                    </div>

                    <x-label for="status" value="Status" />
                    <select id="countries" name="status"
                        class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
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
    {{-- Content --}}
</x-guest-layout>

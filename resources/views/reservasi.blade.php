<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-8">
                    <div class="text-lg font-bold text-primary">Denah Tempat</div>

                    <div class="bg-white shadow-lg rounded-xl p-8">
                        <div class="flex justify-center items-center mb-5">
                            <div class="w-52">
                                <img class="w-full h-full" src="/img/reservation-stage.png" alt="Panggung" />
                                <div class="text-center -mt-2">Panggung</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-6">

                            @foreach ($tables as $table)
                                @if ($table->status == 'Tidak Tersedia')
                                    <div
                                        class="border rounded-lg flex items-center justify-center h-20 bg-gray-500 text-white">
                                    @else
                                        <div
                                            class="border rounded-lg flex items-center justify-center h-20 text-primary">
                                @endif
                                <div class="text-2xl font-bold">{{ $table->table }}</div>
                        </div>
                        @endforeach


                    </div>

                    <div class="grid grid-cols-2 mt-10">
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
            <div class="col-span-4">

                <form action="{{ route('reservasi.detail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-lg font-bold text-primary mb-2">Pilih Tanggal & Waktu</div>

                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <div class="text-sm font-bold text-primary mb-2">Tanggal</div>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input datepicker="" datepicker-format="mm/dd/yyyy" type="text" name="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 datepicker-input"
                                    placeholder="Select date" required>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-primary mb-2">Waktu</div>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <select id="time" name="time" required
                                    class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                    @foreach ($times as $time)
                                        <option value="{{ $time->time }}">{{ $time->time }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <x-button>
                            Periksa Ketersediaan
                        </x-button>
                    </div>

                </form>
            </div>
        </div>

    </div>
    {{-- Content --}}

    </div>
</x-guest-layout>

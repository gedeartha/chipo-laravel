<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-8">
                    <div class="text-lg font-bold text-primary">Reservasi Tempat</div>

                    <div class="bg-white shadow-lg rounded-xl p-8">
                        <div class="flex justify-center items-center mb-5">
                            <div class="w-52">
                                <img class="w-full h-full" src="/img/reservation-stage.png" alt="Panggung" />
                                <div class="text-center -mt-2">Panggung</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-6">
                            @php
                                $dateGet = session()->get('reservation_date');
                                $timeGet = session()->get('reservation_time');
                                
                                $date = date('Y-m-d', strtotime($dateGet));
                                $nextDay = date('Y-m-d', strtotime($date . '+1 day'));
                                
                                $invoiceGet = DB::table('reservations')
                                    ->where('reservation_date', '>=', $date)
                                    ->where('reservation_date', '<', $nextDay)
                                    ->where('reservation_time', '=', $timeGet)
                                    ->where('status', 'Sudah Dibayar')
                                    ->get();
                                // dd($invoiceGet);
                            @endphp

                            @foreach ($tables as $table)
                                @php
                                    $tableCek = DB::table('reservation_tables')
                                        ->where('reservation_date', '=', session()->get('reservation_date'))
                                        ->where('reservation_time', '=', session()->get('reservation_time'))
                                        ->where('table_id', $table->table)
                                        ->count();
                                    // echo $tableCek;
                                    
                                    $tableSelected = DB::table('reservation_tables')
                                        ->where('invoice', session()->get('invoiceReservation'))
                                        ->where('table_id', $table->table)
                                        ->count();
                                @endphp
                                @if ($tableSelected == 1)
                                    <div
                                        class="border rounded-lg flex items-center justify-center h-20 bg-blue-500 text-white">
                                    @elseif ($table->status == 'Tidak Tersedia' || $tableCek == 1)
                                        <div
                                            class="border rounded-lg flex items-center justify-center h-20 bg-gray-500 text-white">
                                        @else
                                            <a href="{{ route('reservasi.cart', $table->table) }}">
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
            <div class="col-span-4">

                <div class="text-lg font-bold text-primary mb-2">Detail</div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-sm font-bold text-primary mb-2">Tanggal</div>
                        <div>
                            @php
                                $dateGet = session()->get('reservation_date');
                                $date = date('d M Y', strtotime($dateGet));
                            @endphp
                            {{ $date }}
                        </div>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-primary mb-2">Waktu</div>
                        <div>{{ session()->get('reservation_time') }}</div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-4">
                    <div class="border-b border-b-gray-300 py-1">
                        <div class="text-sm font-bold text-primary py-2 text-center">Tempat Terpilih</div>
                    </div>


                    @foreach ($tableLists as $table)
                        <div class="border-b border-b-gray-300 py-3">
                            <div class="flex items-center justify-between px-2">
                                <div class="flex justify-center items-center">
                                    <div class="h-6 w-6">
                                        <img class="h-full w-full" src="/img/reservation-seat.svg"
                                            alt="Kursi Terpilih" />
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-primary py-2 text-center ml-2">
                                            {{ $table->table_id }}</div>
                                    </div>
                                </div>
                                <div class="h-6 w-6 rounded-full text-center">

                                    <form action="{{ route('reservasi.delete', $table->table_id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('reservasi.checkout') }}">
                    <div class="text-right mt-3">
                        <x-button>
                            Checkout
                        </x-button>
                    </div>
                </a>
            </div>
        </div>
    </div>

    </div>
    {{-- Content --}}

    </div>
</x-guest-layout>

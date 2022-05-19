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
                                @endphp
                                @if ($table->status == 'Tidak Tersedia' || $tableCek == 1)
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
                        @php
                            $dateGet = session()->get('reservation_date');
                            $date = date('d M Y', strtotime($dateGet));
                        @endphp
                        {{ $date }}
                    </div>
                    <div>
                        <div class="text-sm font-bold text-primary mb-2">Waktu</div>
                        <div>{{ $time }}</div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl p-4">
                    <div class="border-b border-b-gray-300 py-1">
                        <div class="text-sm font-bold text-primary py-2 text-center">Tempat Terpilih</div>
                    </div>

                    <div class="border-b border-b-gray-300 py-3">
                        <div class="flex items-center justify-between px-2">
                            <div class="text-sm mx-auto italic">(Belum ada tempat terpilih)</div>
                        </div>
                    </div>

                </div>

                <a href="{{ route('reservasi') }}"
                    class="py-2.5 px-5 block text-center text-sm font-bold text-white focus:outline-none shadow-lg  bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 hover:border hover:border-tertiary">Kembali</a>
            </div>
        </div>

    </div>
    {{-- Content --}}

    </div>
</x-guest-layout>

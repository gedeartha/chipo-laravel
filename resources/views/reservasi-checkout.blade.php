<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">
        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="flex flex-col justify-between h-[90vh]">
                <div>
                    <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
                    <div class="flex justify-between">

                        <div class="text-lg font-bold text-primary">Checkout</div>
                        <div>
                            <a href="{{ route('reservasi.cart', 0) }}"
                                class="py-2.5 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg  bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 hover:border hover:border-tertiary">
                                Edit Pesanan</a>
                        </div>
                    </div>


                    <div class="mt-2 bg-white shadow-lg rounded-xl p-4">
                        <div class="pb-4 pt-2 px-2 border-1 border-b border-b-gray-300">
                            <div class="font-medium text-gray-600">Ringkasan Pesanan</div>
                        </div>

                        <div class="flex justify-between items-center px-2 py-3">
                            <div class="font-medium text-gray-600">Dipesan oleh</div>
                            <div class="text-lg font-bold text-primary">{{ session()->get('name') }}</div>
                        </div>

                        <div class="flex justify-between items-center px-2 py-3">
                            <div class="font-medium text-gray-600">Tanggal</div>
                            <div class="text-lg font-bold text-primary">
                                @php
                                    $dateGet = session()->get('reservation_date');
                                    $date = date('d M Y', strtotime($dateGet));
                                    
                                    $time = session()->get('reservation_time');
                                @endphp
                                {{ $date }} {{ $time }}</div>
                        </div>

                        <div class="flex justify-between items-center px-2 py-3">
                            <div class="font-medium text-gray-600">No. Meja</div>
                            <div class="text-lg font-bold text-primary">
                                @foreach ($reservationTables as $reservationTable)
                                    {{ $reservationTable->table_id }},
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl px-4 py-5 mt-4">
                    <div class="flex justify-between items-center space-x-10">
                        <div class="flex-none w-40 font-semibold ml-2">Total pembayaran</div>
                        <div class="flex-auto text-right font-bold text-xl text-primary">
                            Rp
                            {{ number_format($totalPayment, 0, ',', '.') }}
                        </div>
                        <div class="flex-none w-56">

                            <a href="{{ route('reservasi.update') }}"
                                class="py-2.5 px-5 block text-center text-sm font-bold text-white focus:outline-none shadow-lg  bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 hover:border hover:border-tertiary">Lanjut
                                ke Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

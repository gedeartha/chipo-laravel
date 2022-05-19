<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 px-10 pt-10">

            <div class="text-center">
                <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
                <div class="text-lg font-bold text-primary">Invoice Pesanan</div>
            </div>

            <div class="flex space-x-10 justify-center">
                <div class="text-center">
                    <div class="flex justify-center items-center mt-20">
                        <div class="w-96 rounded-xl border-2 border-gray-300 shadow-md pb-6 px-4">
                            <div class="-mt-12 flex flex-row justify-center">
                                <img class="h-24 w-24" src="/img/icon-success.svg" />
                            </div>
                            <div class="text-lg font-bold text-primary mt-4">Sukses</div>
                            <div class="text-base text-gray-500 mt-4">
                                Pesanan telah berhasil dibuat
                                @php
                                    $status = $order->status;
                                    
                                    if ($status == 'Belum Dibayar') {
                                        $message = 'Mohon selesaikan pembayaran agar pesanan Anda segera diproses';
                                    } elseif ($status == 'Sudah Dibayar') {
                                        $message = 'Mohon menunggu makanan Anda akan segera diantarkan';
                                    } else {
                                        $message = '';
                                    }
                                    
                                @endphp
                                <br />{{ $message }}
                            </div>
                            <div class="text-3xl font-bold text-primary my-4">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </div>
                            <div class="flex flex-col space-y-2 mt-5">
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Status</div>
                                    <div class="text-base font-bold text-primary">{{ $order->status }}</div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Invoice</div>
                                    <div class="text-base font-bold text-primary">#{{ $order->invoice }}</div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">No. Meja</div>
                                    <div class="text-base font-bold text-primary">{{ $order->table }}</div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Dipesan oleh</div>
                                    <div class="text-base font-bold text-primary">
                                        @php
                                            $user = DB::table('users')
                                                ->where('id', $order->user_id)
                                                ->first();
                                        @endphp
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Tanggal</div>
                                    @php
                                        $dateGet = $order->created_at;
                                        $date = date('d M Y H:i', strtotime($dateGet));
                                    @endphp
                                    <div class="text-base font-bold text-primary">
                                        {{ $date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="max-h-fit w-96 mx-auto">
                        <div class="mt-5 relative overflow-x-auto rounded-lg shadow-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Menu
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Topping
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($orderMenus as $orderMenu)
                                        <tr
                                            class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $orderMenu->menu }}
                                            </th>
                                            <td class="px-6 py-4 text-center">
                                                @php
                                                    
                                                    $toppings = DB::table('order_items')
                                                        ->where('menu_id', $orderMenu->menu_id)
                                                        // ->pluck('topping');
                                                        ->get();
                                                @endphp

                                                @foreach ($toppings as $topping)
                                                    {{ $topping->topping }},
                                                @endforeach
                                            </td>
                                        </tr>

                                    @empty
                                        <tr
                                            class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                            <th colspan="7" scope="row"
                                                class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                                <div class="my-6 text-gray-400">
                                                    Invoice tidak memiliki pesanan
                                                </div>
                                            </th>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center">

                    <form action="{{ $order->invoice }}/update" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="flex justify-center items-center mt-20">
                            <div class="w-96 rounded-xl border-2 border-gray-300 shadow-md pb-5 px-4">
                                <div class="text-lg font-bold text-primary mt-4 mb-4">Pembayaran</div>

                                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                    role="alert">
                                    @php
                                        if ($order->status == 'Sudah Dibayar') {
                                            echo 'Bukti transfer berhasil diupload';
                                        } elseif ($order->status == 'Cash') {
                                            echo 'Sistem pembayaran cash terpilih';
                                        } else {
                                            echo 'Mohon memilih metode pembayaran';
                                        }
                                    @endphp
                                </div>

                                @if (session('errorInvoice'))
                                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                                        role="alert">
                                        <span class="font-medium">Failed!</span> {{ session('errorInvoice') }}
                                    </div>
                                @endif

                                @if ($order->status !== 'Sudah Dibayar')
                                    <div class="text-base text-gray-500 mt-4">
                                        Silahkan transfer ke nomor Rekening dibawah ini
                                    </div>
                                @endif

                                <div class="text-base font-bold text-primary my-2">
                                    Bank Central Asia
                                </div>
                                <div class="text-lg">
                                    8831928442
                                </div>
                                <div class="text-xl font-bold text-primary my-2">
                                    Koko Celamitan
                                </div>
                                <div class="text-3xl font-bold text-primary my-4">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </div>

                                @if ($order->status !== 'Sudah Dibayar')
                                    <div class="border-t-2 py-4">
                                        <x-label for="payment" value="Pilih Metode Pembayaran" class="mb-4" />
                                        <select id="payment" name="payment"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            required autofocus>
                                            @if ($order->payment == '-')
                                                <option value="">Pilih metode pembayaran</option>
                                                <option value="Transfer">Transfer</option>
                                                <option value="Cash">Cash</option>
                                            @endif
                                        </select>
                                        <div class="text-xs my-4">
                                            Mohon upload bukti transfer jika Anda memilih <br /><b>Metode Pembayaran
                                                Transfer</b>
                                        </div>

                                        <input
                                            class="block mt-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-transparent"
                                            id="image" type="file" name="image">

                                        <div class="mt-5">
                                            <x-button>
                                                Submit
                                            </x-button>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

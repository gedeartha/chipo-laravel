<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 px-10 pt-10">

            <div class="text-center">
                <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
                <div class="text-lg font-bold text-primary">Invoice Pesanan Topping</div>
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
                                        @php
                                            $menu = DB::table('menus')
                                                ->where('id', $orderMenu->menu)
                                                ->first();
                                        @endphp
                                        <tr
                                            class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $menu->name }}
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

                @if ($order->status != 'Sudah Dibayar')
                    <div class="text-center">

                        <div class="flex justify-center items-center mt-20">
                            <div class="w-96 rounded-xl border-2 border-gray-300 shadow-md pb-5 px-4">
                                <div class="text-lg font-bold text-primary mt-4 mb-4">Pembayaran</div>

                                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                    role="alert">
                                    @php
                                        if ($order->status == 'Cash') {
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
                                    <div class="border-t-2 pt-4">

                                        <div class="flex justify-between items-center">
                                            <div class="ml-5">
                                                <a href="{{ $order->invoice }}/update?invoice={{ $order->invoice }}">
                                                    <x-button>
                                                        Cash
                                                    </x-button>
                                                </a>
                                            </div>

                                            @if ($order->status != 'Sudah Dibayar')
                                                <div class="mr-5">
                                                    <button id="pay-button"
                                                        class="py-2.5 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 border hover:border-tertiary">
                                                        Transfer
                                                    </button>
                                                </div>
                                            @endif
                                        </div>

                                        <form action="" id="submit_form" method="POST">
                                            @csrf
                                            <input type="hidden" name="invoice" value="{{ $order->invoice }}">
                                            <input type="hidden" name="json" id="json_callback">
                                        </form>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
        {{-- Content --}}

    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay(`{{ $snap_token }}`, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    // console.log(result);
                    send_response_to_form(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    // alert("wating your payment!");
                    // console.log(result);
                    send_response_to_form(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment failed!");
                    // console.log(result);
                    send_response_to_form(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            // alert(document.getElementById('json_callback').value);
            $('#submit_form').submit();
        }
    </script>
</x-guest-layout>

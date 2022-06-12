<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="font-extrabold text-3xl text-primary mb-4">Detail Pesanan #{{ $order->invoice }}</div>
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

            <div class="grid grid-cols-12">
                <div class="col-span-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <div class="mb-1">Status</div>

                            @if ($order->status == 'Selesai')
                                <div
                                    class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-green-500 rounded-lg border border-green-500">
                                    Selesai</div>
                            @endif

                            @if ($order->status == 'Proses' || $order->status == 'Sudah Dibayar' || $order->status == 'Cash')
                                <div
                                    class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-blue-500 rounded-lg border border-blue-500">
                                    {{ $order->status }}</div>
                            @endif

                            @if ($order->status == 'Pending' || $order->status == 'Belum Dibayar')
                                <div
                                    class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-yellow-400 rounded-lg border border-yellow-400">
                                    {{ $order->status }}</div>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-1">Tanggal</div>
                            <div class="font-bold text-base">
                                @php
                                    $dateGet = $order->created_at;
                                    $date = date('d M Y H:i', strtotime($dateGet));
                                @endphp
                                {{ $date }}
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-1">Dipesan oleh</div>
                            <div class="font-bold text-base">
                                @php
                                    $user = DB::table('users')
                                        ->where('id', $order->user_id)
                                        ->first();
                                @endphp
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-1">No. Meja</div>
                            <div class="font-bold text-base">
                                {{ $order->table }}
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-1">Jumlah Pesanan</div>
                            <div class="font-bold text-base">
                                {{ $quantity }}
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-1">Total Pembayaran</div>
                            <div class="font-bold text-base">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- <div class="flex flex-col">
                            <div class="mb-1">Bukti Pembayaran</div>
                            <div class="font-bold text-base">
                                <a href="{{ Storage::url('proof/') . $order->proof }}"
                                    class="flex space-x-1 items-center" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div class="font-normal">bukti_pembayaran_{{ $order->invoice }}
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="mb-1 mt-4">Detail Pesanan</div>

            <div class="max-h-fit">
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
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga Menu
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga Topping
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orderMenus as $orderMenu)
                                <tr
                                    class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        @php
                                            $menu = DB::table('menus')
                                                ->where('id', $orderMenu->menu)
                                                ->first();
                                        @endphp
                                        {{ $menu->name }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        {{-- Harga Menu --}}
                                        @php
                                            $toppings = DB::table('order_items')
                                                ->where('menu_id', $orderMenu->menu_id)
                                                ->get();
                                        @endphp

                                        @foreach ($toppings as $topping)
                                            {{ $topping->topping }},
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        Rp {{ number_format($orderMenu->menu_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Harga Topping --}}
                                        @php
                                            $toppings = DB::table('order_items')
                                                ->where('menu_id', $orderMenu->menu_id)
                                                ->get();
                                            
                                            $totalTopping = 0;
                                        @endphp

                                        @foreach ($toppings as $topping)
                                            @php
                                                $totalTopping = $totalTopping + $topping->topping_price;
                                            @endphp
                                        @endforeach

                                        Rp {{ number_format($totalTopping, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Total --}}
                                        Rp {{ number_format($totalTopping + $orderMenu->menu_price, 0, ',', '.') }}
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

            <div class="grid grid-cols-12 mt-4">
                @if ($order->status != 'Selesai')
                    <div class="col-span-6">
                        <div class="shadow-md bg-white rounded-xl p-5">

                            <form action="{{ $order->invoice }}/update" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="font-bold text-lg text-primary mb-2">Ubah Status</div>
                                <hr class="mb-2" />

                                <div class="mb-3">
                                    <x-label for="status" value="Status" />
                                    <select id="countries" name="status"
                                        class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                        <option value="">Pilih Status</option>
                                        @if ($order->status == 'Sudah Dibayar' || $order->status == 'Cash')
                                            <option value="Proses">Proses</option>
                                        @endif
                                        <option value="Selesai">Selesai</option>
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
                @endif
            </div>

        </div>
        {{-- Content --}}
</x-guest-layout>

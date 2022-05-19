<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
            <div class="flex justify-between">

                <div class="text-lg font-bold text-primary">Checkout</div>
                <div>
                    <a href="{{ route('menu') }}"
                        class="py-2.5 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg  bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 hover:border hover:border-tertiary">+
                        Tambah Pesanan</a>
                </div>
            </div>


            <div class="mt-2 bg-white shadow-lg rounded-xl p-4">
                <div>Dipesan oleh:</div>
                <div class="font-bold text-base">{{ session()->get('user_name') }}</div>
            </div>

            <div class="my-5 text-base font-bold text-primary">Detail Pesanan</div>

            <div class="bg-white shadow-lg rounded-xl p-4">
                @php
                    $index = 1;
                    $total_menu = 0;
                    $total_topping = 0;
                    $total = 0;
                @endphp

                @forelse ($order_menus as $order_menu)
                    @php
                        $total_menu = $total_menu + $order_menu->menu_price;
                    @endphp
                    <div>
                        <div class="text-sm font-bold text-primary p-2">Pesanan {{ $index }}</div>
                        <div class="border-b border-b-gray-300"></div>

                        <div class="flex items-center space-x-3 p-2 border-b border-b-gray-300">
                            <div class="flex-none w-14">
                                <img class="h-full w-full rounded-full" src="/img/menu-bubur-ayam.png"
                                    alt="Bubur Ayam" />
                            </div>
                            <div class="flex-auto">
                                <div class="font-bold text-md text-primary">{{ $order_menu->menu }}</div>
                                <div class="font-semibold text-base text-gray-500">Rp
                                    {{ number_format($order_menu->menu_price, 0, ',', '.') }}</div>
                            </div>
                            <div class="flex-none w-20">
                                <div class="flex justify-center items-center">
                                    <div class="h-6 w-6 rounded-full text-center">

                                        <form action="/checkout/delete/{{ $order_menu->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-primary p-2">Topping Pesanan {{ $index }}
                            </div>
                            <div class="border-b border-b-gray-300"></div>

                            @php
                                $toppings = DB::table('order_items')
                                    ->join('toppings', 'order_items.topping', '=', 'toppings.name')
                                    ->where('menu_id', $order_menu->menu_id)
                                    ->get();
                            @endphp
                            @forelse ($toppings as $topping)
                                @php
                                    $total_topping = $total_topping + $topping->price;
                                @endphp
                                {{-- @if ($topping->menu_id == $order_menu->menu_id) --}}
                                <div class="flex items-center space-x-3 ml-6 p-2">
                                    <div class="flex-none w-14">
                                        <img class="h-full w-full rounded-full"
                                            src="{{ Storage::url('upload/') . $topping->image }}"
                                            alt="{{ $topping->name }}" />
                                    </div>
                                    <div class="flex-auto">
                                        <div class="font-bold text-md text-primary">{{ $topping->name }}</div>
                                        <div class="font-semibold text-base text-gray-500">Rp
                                            {{ number_format($topping->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="border-b border-b-gray-300"></div>
                                {{-- @endif --}}
                            @empty
                                <div class="px-6 py-2 font-medium whitespace-nowrap text-center">
                                    <div class="mt-1 text-gray-400">
                                        Tanpa tambahan topping
                                    </div>
                                </div>
                            @endforelse

                        </div>

                    </div>

                    @php
                        $index = $index + 1;
                        $total = $total_menu + $total_topping;
                    @endphp
                @empty
                    <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th colspan="4" scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                            <div class="my-6 text-gray-400">
                                Checkout pesanan kosong
                            </div>
                        </th>
                    </tr>
                @endforelse
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4">
                <div class="flex justify-between items-center space-x-10">
                    <div class="flex-none w-36 font-semibold">Total ({{ count($order_menus) }} Pesanan)</div>
                    <div class="flex-auto text-right font-bold text-xl text-primary">Rp
                        {{ number_format($total, 0, ',', '.') }}</div>
                    <div class="flex-none w-56">

                        <form method="POST" action="{{ route('checkout.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <x-input id="total" class="hidden mt-2 w-full" type="number" name="total"
                                value="{{ $total }}" />

                            <x-button>
                                Pesan Sekarang
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}
    </div>
</x-guest-layout>

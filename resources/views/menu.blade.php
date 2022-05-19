<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="text-primary text-xl tracking-wider">Anda lapar?</div>
            <div class="text-2xl font-bold text-primary mb-8">Mari nikmati bubur ayam spesial hari ini</div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12">
                <div class="col-span-4 mr-8">
                    <div class="block">
                        <img class="h-full w-full rounded-2xl" src="{{ Storage::url('upload/') . $menu->image }}"
                            alt="Bubur Ayam" />
                    </div>
                    <div class="font-semibold text-md text-primary py-4">Deskripsi</div>
                    <div class="-mt-2 text-md text-gray-500">{{ $menu->description }}</div>
                </div>
                <div class="col-span-8">
                    <div class="font-extrabold text-4xl text-primary">{{ $menu->name }}</div>
                    <div class="flex items-center my-2">
                        <div class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-md text-gray-500 ">Proses pembuatan ± 5 menit</div>
                    </div>
                    <div class="font-extrabold text-3xl text-primary">Rp
                        {{ number_format($menu->price, 0, ',', '.') }}</div>

                    <div class="mt-2 bg-white shadow-lg rounded-xl p-4">

                        <div class="font-bold text-lg text-primary pb-2 border-b border-b-gray-300">Topping</div>

                        @php
                            $invoice = session()->get('invoice');
                            $orders = DB::table('orders')
                                ->where('invoice', $invoice)
                                ->exists();
                        @endphp

                        @if ($orders)
                            <form method="POST" action="{{ route('menu.update') }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                            @else
                                <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                                    @csrf
                        @endif

                        <div class="hidden">
                            <x-input id="totalTopping" class="block mt-2 w-full" type="text" name="totalTopping"
                                value="{{ count($toppings) }}" />
                            <x-input id="menu_price" class="block mt-2 w-full" type="text" name="menu_price"
                                value="{{ $menu->price }}" />
                        </div>

                        @forelse ($toppings as $topping)
                            <div class="flex items-center space-x-3 p-2 border-b border-b-gray-300">
                                <div class="flex-none w-14">
                                    <img class="h-full w-full rounded-xl"
                                        src="{{ Storage::url('upload/') . $topping->image }}" alt="Telur Puyuh" />
                                </div>
                                <div class="flex-auto">
                                    <div class="font-bold text-md text-primary">{{ $topping->name }}</div>
                                    <div class="font-bold text-md text-primary">Rp
                                        {{ number_format($topping->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="flex-none w-20">
                                    <div class="hidden">
                                        <x-input id="name" class="block mt-2 w-full" type="text"
                                            name="name[{{ $topping->id }}]" value="{{ $topping->name }}" />

                                        <x-input id="price" class="block mt-2 w-full" type="text"
                                            name="price[{{ $topping->id }}]" value="{{ $topping->price }}" />

                                        <x-input id="toggleValue[{{ $topping->id }}]" class="block mt-2 w-full"
                                            type="text" name="toggleValue[{{ $topping->id }}]" value="0" />
                                    </div>

                                    <label for="toggle[{{ $topping->id }}]"
                                        class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="0" id="toggle[{{ $topping->id }}]"
                                            name="toggle[{{ $topping->id }}]" class="sr-only peer"
                                            onclick=getValue()>
                                        <div
                                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div>

                        @empty
                            <tr
                                class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                <th colspan="4" scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                    <div class="my-6 text-gray-400">
                                        Daftar topping kosong
                                    </div>
                                </th>
                            </tr>
                        @endforelse

                        <div class="text-right mt-6 mb-2">
                            <x-button>
                                Proses Checkout
                            </x-button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}
    </div>

    <script>
        var totalTopping = document.getElementById('totalTopping').value;

        function getValue() {
            for (let i = 1; i <= totalTopping; i++) {
                var toggle = 'toggle[' + i + ']';
                var toggleValue = 'toggleValue[' + i + ']';

                if (document.getElementById(toggle).checked) {
                    var value = 1;
                    document.getElementById(toggleValue).value = value;
                } else {
                    var value = 0;
                    document.getElementById(toggleValue).value = value;
                }

                console.log(toggle + ' : ' + value);
            }

        }
    </script>
</x-guest-layout>

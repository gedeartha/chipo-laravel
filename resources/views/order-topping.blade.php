<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="p-10">
            <div class="text-primary text-xl tracking-wider">Mau Topping Aja?</div>
            <div class="text-2xl font-bold text-primary mb-8">Kamu bisa pesen topping aja disini</div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-5 gap-10">
                @foreach ($toppings as $topping)
                    @php
                        $invoice = session()->get('invoice');
                        $orders = DB::table('orders')
                            ->where('invoice', $invoice)
                            ->exists();
                    @endphp

                    @if ($orders)
                        <form method="POST" action="{{ route('order-topping.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                        @else
                            <form method="POST" action="{{ route('order-topping.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                    @endif

                    <div class="hidden">
                        <x-input id="topping_id" class="block mt-2 w-full" type="text" name="topping_id"
                            value="{{ $topping->id }}" />
                        <x-input id="topping_name" class="block mt-2 w-full" type="text" name="topping_name"
                            value="{{ $topping->name }}" />
                        <x-input id="topping_price" class="block mt-2 w-full" type="text" name="topping_price"
                            value="{{ $topping->price }}" />
                    </div>

                    <div class="bg-white shadow-md rounded-2xl">
                        <img class="w-full h-64 object-cover rounded-t-2xl"
                            src="{{ Storage::url('upload/') . $topping->image }}" alt="Topping" />

                        <div class="p-5">
                            <div class="font-extrabold text-xl mb-1">
                                {{ $topping->name }}
                            </div>
                            <div class="font-bold text-xl text-gray-600 mb-2">
                                Rp {{ number_format($topping->price, 0, ',', '.') }}
                            </div>

                            <hr class="mb-3 mt-4" />

                            <div class="flex space-x-4 h-10 items-center">
                                <input type="number" id="qty" name="qty"
                                    class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0" required>

                                <button
                                    class="w-full py-2 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg bg-tertiary rounded-xl hover:bg-gray-100 hover:text-blue-700 border hover:border-tertiary">Pesan
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>

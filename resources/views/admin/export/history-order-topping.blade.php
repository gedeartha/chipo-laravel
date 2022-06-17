<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">

            <div class="font-extrabold text-3xl text-primary mb-4">Export Riwayat Order Topping</div>
            <hr class="mb-4" />

            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-2">
                    <div class="shadow-md bg-white rounded-xl p-5">

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

                        <form action="" enctype="multipart/form-data">
                            <!-- Start Date -->
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <x-label for="name" value="Dari Tanggal" />
                                    <div class="relative mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker type="text" name="date_start" required
                                            datepicker-format="dd/mm/yyyy"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                            placeholder="Pilih tanggal">
                                    </div>
                                </div>

                                <div>
                                    <x-label for="name" value="Sampai Tanggal" />
                                    <div class="relative mt-2">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker type="text" name="date_end" required
                                            datepicker-format="dd/mm/yyyy"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                            placeholder="Pilih tanggal">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end h-full w-full mt-5">
                                <x-button>
                                    Submit
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-span-10">

                    @if (session('warning'))
                        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                            role="alert">
                            <span class="font-medium">Failed!</span> {{ session('warning') }}
                        </div>
                    @endif

                    <div class="text-right">
                        <a href="{{ route('admin.export.order-topping.download') }}">
                            <x-button-small>
                                <div class="flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <div class="ml-1 mr-2">
                                        Export
                                    </div>
                                </div>
                            </x-button-small>
                        </a>
                    </div>

                    <div class="h-[75vh]">
                        <div class="mt-5 relative overflow-x-auto rounded-lg shadow-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Invoice
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Dipesan oleh
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            No. Meja
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Jumlah Pesanan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($orders as $order)
                                        <tr
                                            class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                #{{ $order->invoice }}
                                            </th>
                                            <td class="px-6 py-4 text-center">
                                                {{ $order->created_at }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $order->user_id)
                                                        ->first();
                                                @endphp
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $order->table }}
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $orderCount = DB::table('order_topping_items')
                                                        ->where('invoice', $order->invoice)
                                                        ->count();
                                                @endphp
                                                {{ $orderCount }}
                                            </td>
                                            <td class="text-center">
                                                {{ $order->status }}
                                            </td>
                                        </tr>

                                    @empty
                                        <tr
                                            class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                            <th colspan="7" scope="row"
                                                class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                                <div class="my-6 text-gray-400">
                                                    Riwayat pesanan kosong
                                                </div>
                                            </th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Content --}}
    </div>
</x-guest-layout>

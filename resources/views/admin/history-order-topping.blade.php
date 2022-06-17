<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="flex justify-between">
                <div class="font-extrabold text-3xl text-primary mb-4">Riwayat Pesanan Topping</div>

                <a href="{{ route('admin.export.history-order-topping') }}">
                    <x-button-small>
                        <div class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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

            <hr class="mb-4" />


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
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orders as $order)
                                <tr
                                    class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                            $orderCount = DB::table('order_menus')
                                                ->where('invoice', $order->invoice)
                                                ->count();
                                        @endphp
                                        {{ $orderCount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->status }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.detail-history-order-topping', $order->invoice) }}">
                                            <button
                                                class="py-1.5 px-2.5 text-center text-sm font-semibold text-blue-700 rounded-lg border border-blue-700">Detail</button>
                                        </a>
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

            <div class="text-center mt-10">
                {{-- <nav aria-label="Page navigation example">
                    <ul class="inline-flex items-center -space-x-px">
                        <li>
                            <a href="#"
                                class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                        </li>
                        <li>
                            <a href="#"
                                class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
        {{-- Content --}}
</x-guest-layout>

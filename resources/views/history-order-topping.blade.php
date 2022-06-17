<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 px-10 pt-10">
            <div class="flex flex-col justify-between">
                <div>
                    <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
                    <div class="flex justify-between">

                        <div class="text-lg font-bold text-primary">Riwayat Pesanan</div>

                        <form method="POST" action="{{ route('history.search') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="flex space-x-2">
                                <input type="number" id="text" name="invoice"
                                    value="{{ old('invoice', $invoice) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Cari ID Pesanan">
                                <button
                                    class="py-2.5 px-5 flex justify-center items-center text-sm font-bold text-white focus:outline-none shadow-lg  bg-tertiary rounded-lg hover:bg-gray-100 hover:text-blue-700 border hover:border-tertiary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="h-[75vh]">
                    <div class="mt-5 relative overflow-x-auto rounded-lg shadow-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Invoice
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No. Meja
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jumlah Pesanan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
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
                                        <td class="px-6 py-4">
                                            @php
                                                $dateGet = $order->created_at;
                                                $date = date('d M Y H:i', strtotime($dateGet));
                                            @endphp
                                            {{ $date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->table }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $orderCount = DB::table('order_menus')
                                                    ->where('invoice', $order->invoice)
                                                    ->count();
                                            @endphp
                                            {{ $orderCount }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('invoice-topping', $order->invoice) }}">
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

                {{-- Pagination --}}
                {{-- <div class="text-center mt-10">
                    <nav aria-label="Page navigation example">
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
                    </nav>

                </div> --}}
                {{-- Pagination --}}

            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

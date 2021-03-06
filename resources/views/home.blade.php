<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 p-10">
            <div class="text-2xl font-bold text-primary mb-8">Bubur Ayam Koko Celamitan</div>

            {{-- Slider --}}
            <div id="default-carousel" class="relative h-80 -mt-12 lg:-mt-5 xl:-mt-5" data-carousel="static">

                <div class="overflow-hidden rounded-2xl relative h-full">

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20"
                        data-carousel-item="">
                        <span
                            class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First
                            Slide</span>
                        <img src="/img/ads-1.png"
                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                            alt="...">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-full z-10"
                        data-carousel-item="">
                        <img src="/img/ads-2.png"
                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                            alt="...">
                    </div>

                    <div class="duration-700 ease-in-out absolute inset-0 transition-all transform -translate-x-full z-10"
                        data-carousel-item="">
                        <img src="/img/ads-3.png"
                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                            alt="...">
                    </div>
                </div>

                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    <button type="button" class="w-3 h-3 rounded-full bg-white dark:bg-gray-800" aria-current="true"
                        aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button"
                        class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                        aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button"
                        class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                        aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                </div>

                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next="">
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
            {{-- Slider --}}

            <div class="my-6">
                <div class="grid gap-10">

                    <div class="col-span-12">
                        <div class="text-xl font-bold text-primary mb-8">Layanan</div>

                        @if (session('error'))
                            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                                role="alert">
                                <span class="font-medium">Failed!</span> {{ session('error') }}
                            </div>
                        @endif

                        <div class="grid grid-cols-12 gap-10">
                            <div class="col-span-4">
                                <div class="bg-secondary h-72 rounded-2xl flex flex-col justify-center items-center">
                                    <div class=" bg-tertiary rounded-full w-[90px] p-5">
                                        <img class="w-56" src="/img/icon-reservation.svg" />
                                    </div>

                                    <div class="text-lg font-bold text-primary mb-3 mt-4">Reservasi Tempat</div>
                                    <a href="/reservasi"
                                        class="py-2.5 px-5 mr-2 mb-2 w-36 text-center text-sm font-bold text-gray-900 focus:outline-none shadow-lg  bg-white rounded-full hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Reservasi</a>
                                </div>
                            </div>

                            <div class="col-span-4">
                                <div class="bg-secondary h-72 rounded-2xl flex flex-col justify-center items-center">
                                    <div class=" bg-blueLight rounded-full w-[90px] p-5">
                                        <img class="w-56" src="/img/icon-menu.svg" />
                                    </div>

                                    <div class="text-lg font-bold text-primary mb-3 mt-4">Pesan Makanan</div>
                                    <a href="/menu"
                                        class="py-2.5 px-5 mr-2 mb-2 w-36 text-center text-sm font-bold text-gray-900 focus:outline-none shadow-lg  bg-white rounded-full hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Pesan</a>
                                </div>
                            </div>

                            <div class="col-span-4">
                                <div class="bg-secondary h-72 rounded-2xl flex flex-col justify-center items-center">
                                    <div class=" bg-blueLightTwo rounded-full w-[90px] p-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-egg-fried w-12 text-white" viewBox="0 0 16 16">
                                            <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            <path
                                                d="M13.997 5.17a5 5 0 0 0-8.101-4.09A5 5 0 0 0 1.28 9.342a5 5 0 0 0 8.336 5.109 3.5 3.5 0 0 0 5.201-4.065 3.001 3.001 0 0 0-.822-5.216zm-1-.034a1 1 0 0 0 .668.977 2.001 2.001 0 0 1 .547 3.478 1 1 0 0 0-.341 1.113 2.5 2.5 0 0 1-3.715 2.905 1 1 0 0 0-1.262.152 4 4 0 0 1-6.67-4.087 1 1 0 0 0-.2-1 4 4 0 0 1 3.693-6.61 1 1 0 0 0 .8-.2 4 4 0 0 1 6.48 3.273z" />
                                        </svg>
                                    </div>

                                    <div class="text-lg font-bold text-primary mb-3 mt-4">Pesan Topping</div>
                                    <a href="/order-topping"
                                        class="py-2.5 px-5 mr-2 mb-2 w-36 text-center text-sm font-bold text-gray-900 focus:outline-none shadow-lg  bg-white rounded-full hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="text-xl font-bold text-primary mb-8">Transaksi Pembeli</div>
                        <div class="flex flex-col space-y-4">

                            @foreach ($orders as $order)
                                <div class="bg-secondary p-4 rounded-2xl">
                                    <div class="flex space-x-4">
                                        <div class="p-2 w-14 rounded-xl shadow-md bg-white text-center">
                                            <div class="font-bold text-md">
                                                @php
                                                    $dateGet = $order->updated_at;
                                                    $date = date('d', strtotime($dateGet));
                                                @endphp
                                                {{ $date }}
                                            </div>
                                            <div class="text-sm text-gray-500 -mt-1">
                                                @php
                                                    $dateGet = $order->updated_at;
                                                    $date = date('D', strtotime($dateGet));
                                                @endphp
                                                {{ $date }}</div>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <div class="font-bold text-primary text-md">
                                                @php
                                                    $totalOrder = DB::table('order_menus')
                                                        ->where('invoice', $order->invoice)
                                                        ->count();
                                                @endphp
                                                {{ $totalOrder }} Bubur Ayam
                                            </div>
                                            <div class="text-gray-500 text-sm">

                                                @php
                                                    $user = DB::table('users')
                                                        ->where('id', $order->user_id)
                                                        ->first();
                                                @endphp
                                                {{ $user->name }}

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="inline-flex bi bi-dot"
                                                    viewBox="0 0 16 16">
                                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                                </svg>

                                                <span class="font-semibold">

                                                    @php
                                                        $dateGet = $order->updated_at;
                                                        $date = date('H:i', strtotime($dateGet));
                                                    @endphp
                                                    {{ $date }} WITA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Transaction --}}
                </div>
            </div>
        </div>
        {{-- Content --}}
    </div>
</x-guest-layout>

<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-10 px-10 pt-10">

            <div class="text-center">
                <div class="text-2xl font-bold text-primary mb-4">Bubur Ayam Koko Celamitan</div>
                <div class="text-lg font-bold text-primary">Invoice Reservasi</div>
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
                                @php
                                    $status = $reservation->status;
                                @endphp
                                @if ($status == 'Belum Dibayar')
                                    Reservasi telah berhasil dibuat
                                    Mohon selesaikan pembayaran agar pesanan Anda segera diproses
                                @endif
                                @if ($status == 'Sudah Dibayar')
                                    Terimakasih telah melakukan reservasi online
                                    Tempat akan kami siapkan
                                @endif
                            </div>
                            <div class="text-3xl font-bold text-primary my-4">
                                Rp {{ number_format($reservation->total, 0, ',', '.') }}
                            </div>
                            <div class="flex flex-col space-y-2 mt-5">
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Status</div>
                                    <div class="text-base font-bold text-primary">{{ $reservation->status }}</div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Invoice</div>
                                    <div class="text-base font-bold text-primary">#{{ $reservation->invoice }}</div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">No. Meja</div>
                                    <div class="text-base font-bold text-primary">
                                        @foreach ($reservationTables as $reservationTable)
                                            {{ $reservationTable->table_id }},
                                        @endforeach
                                    </div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Dipesan oleh</div>
                                    <div class="text-base font-bold text-primary">
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <div class="text-base">Tanggal Reservasi</div>
                                    @php
                                        $dateGet = $reservation->reservation_date;
                                        $date = date('d M Y', strtotime($dateGet));
                                    @endphp
                                    <div class="text-base font-bold text-primary">
                                        {{ $date }} {{ $reservation->reservation_time }}</div>
                                </div>
                            </div>

                            @if ($reservation->status == 'Belum Dibayar')
                                <div class="mt-5">
                                    <button id="pay-button"
                                        class="py-2.5 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 border hover:border-tertiary">
                                        Transfer
                                    </button>
                                </div>
                            @endif

                            <form action="" id="submit_form" method="POST">
                                @csrf
                                <input type="hidden" name="invoice" value="{{ $reservation->invoice }}">
                                <input type="hidden" name="json" id="json_callback">
                            </form>

                            <div class="text-sm text-gray-500 mt-4 text-left">
                                <p>Ketentuan : </p>
                                - Jika lebih dari 30 menit setelah jam reservasi Anda belum berada di lokasi, maka
                                reservasi
                                anggap dianggap hangus dan meja dapat digunakan oleh pelanggan lain.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="text-center">

                    <form action="{{ $reservation->invoice }}/update" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="flex justify-center items-center mt-20">
                            <div class="w-96 rounded-xl border-2 border-gray-300 shadow-md pb-5 px-4">
                                <div class="text-lg font-bold text-primary mt-4 mb-4">Pembayaran</div>

                                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                    role="alert">
                                    @php
                                        if ($reservation->status == 'Sudah Dibayar') {
                                            echo 'Bukti transfer berhasil diupload';
                                        } else {
                                            echo 'Mohon selesaikan pembayaran';
                                        }
                                    @endphp
                                </div>

                                @if (session('errorInvoice'))
                                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                                        role="alert">
                                        <span class="font-medium">Failed!</span> {{ session('errorInvoice') }}
                                    </div>
                                @endif

                                @if ($reservation->status !== 'Sudah Dibayar')
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
                                    Rp {{ number_format($reservation->total, 0, ',', '.') }}
                                </div>

                                @if ($reservation->status !== 'Sudah Dibayar')
                                    <div class="border-t-2 py-4">
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
                </div> --}}
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

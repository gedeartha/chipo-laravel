<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="font-extrabold text-3xl text-primary mb-4">Detail Reservasi</div>
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

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-6">
                    <div class="shadow-md bg-white rounded-xl p-5">
                        <div class="font-extrabold text-xl text-primary mb-4">Invoice #R001</div>
                        <hr class="mb-2" />
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <div class="mb-1">Status</div>

                                @if ($reservation->status == 'Selesai')
                                    <div
                                        class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-green-500 rounded-lg border border-green-500">
                                        Selesai</div>
                                @endif

                                @if ($reservation->status == 'Sudah Dibayar')
                                    <div
                                        class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-blue-500 rounded-lg border border-blue-500">
                                        Sudah Dibayar</div>
                                @endif

                                @if ($reservation->status == 'Belum Dibayar')
                                    <div
                                        class="py-1.5 px-2.5 max-w-fit text-center text-sm font-bold text-yellow-400 rounded-lg border border-yellow-400">
                                        Belum Dibayar</div>
                                @endif
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">Tanggal Pemesanan</div>
                                <div class="font-bold text-base">
                                    @php
                                        $dateGet = $reservation->created_at;
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
                                            ->where('id', $reservation->user_id)
                                            ->first();
                                    @endphp
                                    {{ $user->name }}
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">Tanggal Reservasi</div>
                                <div class="font-bold text-base">
                                    @php
                                        $dateGet = $reservation->reservation_date;
                                        $date = date('d M Y', strtotime($dateGet));
                                    @endphp
                                    {{ $date }} {{ $reservation->reservation_time }}
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">Jumlah Pesanan</div>
                                <div class="font-bold text-base">
                                    @php
                                        $reservationCount = DB::table('reservation_tables')
                                            ->where('invoice', $reservation->invoice)
                                            ->count();
                                    @endphp
                                    {{ $reservationCount }}
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">Total Pembayaran</div>
                                <div class="font-bold text-base">
                                    Rp {{ number_format($reservation->total, 0, ',', '.') }}</div>
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">No. Meja</div>
                                <div class="font-bold text-base">
                                    @foreach ($reservationTables as $reservationTable)
                                        {{ $reservationTable->table_id }},
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <div class="mb-1">Bukti Pembayaran</div>
                                @if ($reservation->status == 'Belum Dibayar')
                                    -
                                @else
                                    <div class="font-bold text-base">
                                        <a href="{{ Storage::url('proof/') . $reservation->proof }}"
                                            class="flex space-x-1 items-center" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div class="font-normal">bukti_pembayaran_{{ $reservation->invoice }}
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-6">
                    @if ($reservation->status != 'Selesai')
                        <div class="shadow-md bg-white rounded-xl p-5">

                            <form action="{{ $reservation->invoice }}/update" method="POST"
                                enctype="multipart/form-data">
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
                    @endif
                </div>
            </div>
        </div>
        {{-- Content --}}
</x-guest-layout>

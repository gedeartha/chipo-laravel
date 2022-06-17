<x-guest-layout>
    @include('admin.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class="col-span-8 sm:col-span-9 lg:col-span-10 p-10">
            <div class="grid grid-cols-12 gap-10">
                <div class="col-span-8">
                    <div class="shadow-md bg-white rounded-xl p-5">
                        <div class="font-extrabold text-3xl text-primary mb-4">Edit User</div>
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

                        <form method="POST" action="{{ $user->id }}/update" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <x-label for="name" value="Nama User" />
                                <x-input id="name" class="block mt-2 w-full" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" required autofocus />

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="website-admin"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <div class="flex">
                                    @php
                                        $email = $user->email;
                                        
                                    @endphp
                                    <input type="text" id="email" name="email"
                                        class="rounded-none rounded-l-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                        value="{{ old('email', $email) }}">
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="mb-3">
                                <x-label for="table" value="Meja" />
                                <select id="table" name="table"
                                    class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required autofocus>

                                    <option value="">Pilih Meja
                                    </option>

                                    @foreach ($tables as $table)
                                        @php
                                            $now = date('Y-m-d');
                                            
                                            $tableCek = DB::table('reservation_tables')
                                                ->where('table_id', $table->table)
                                                ->where('reservation_date', $now)
                                                ->count();
                                            
                                            $tomorrow = date('Y-m-d', strtotime('+1 day'));
                                            
                                            //Cek meja jika telah digunakan hari ini
                                            $tableOrderCek = DB::table('orders')
                                                ->where('table', $table->table)
                                                ->where('updated_at', '>=', $now)
                                                ->where('updated_at', '<', $tomorrow)
                                                ->count();
                                        @endphp

                                        @if ($tableCek == 1 || $tableOrderCek == 1)
                                            <option value="{{ $table->table }}" hidden="">{{ $table->table }}
                                            </option>
                                        @else
                                            <option value="{{ $table->table }}">{{ $table->table }}
                                            </option>
                                        @endif
                                    @endforeach
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
            </div>
        </div>
        {{-- Content --}}

    </div>
</x-guest-layout>

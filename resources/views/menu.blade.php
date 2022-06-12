<x-guest-layout>
    @include('components.navigation')

    <div class="ml-64 shrink">

        {{-- Content --}}
        <div class=" p-10">
            <div class="text-primary text-xl tracking-wider">Anda lapar?</div>
            <div class="text-2xl font-bold text-primary mb-8">Mari nikmati bubur ayam spesial hari ini</div>

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-3 gap-10">

                @foreach ($menus as $menu)
                    <div class="mx-10">
                        <div class="bg-white shadow-md rounded-2xl">

                            <img class="w-full h-64 object-cover rounded-t-2xl"
                                src="{{ Storage::url('upload/') . $menu->image }}" alt="Menu" />

                            <div class="p-5">
                                <div class="font-extrabold text-xl mb-2">
                                    {{ $menu->name }}
                                </div>
                                <div class="font-bold text-xl">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>

                                <a href="topping?menu={{ $menu->id }}">
                                    <button
                                        class="w-full mt-4 py-2.5 px-5 text-center text-sm font-bold text-white focus:outline-none shadow-lg bg-tertiary rounded-full hover:bg-gray-100 hover:text-blue-700 border hover:border-tertiary">Pesan
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>

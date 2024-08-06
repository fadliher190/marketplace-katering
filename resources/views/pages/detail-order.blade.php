@extends('layout.app')
@section('page-content')
    <main class="w-full min-h-screen">
        <navbar class="w-full flex flex-col">
            <div class="flex flex-row text-xs gap-2 p-2 bg-blue-600 text-white items-center">
                <a href="{{ route('merchant.dashboard') }}">Portal Merchant</a>
                <a href="#">Bantuan</a>
                <div class="flex-auto"></div>
                @if (Auth::check())
                    <a href="" class="block h-full flex flex-row items-center gap-2">
                        <div class="h-full aspect-square bg-white rounded-full overflow-hidden">
                            <img src="" alt="" class="w-full h-full">
                        </div>
                        <span>{{ Auth::user()->username }}</span>
                    </a>
                @else
                    <a href="{{ route('auth.sign-up') }}" class="">Daftar</a>
                    <a href="{{ route('auth.sign-in') }}" class="">Masuk</a>
                @endif
            </div>
            <div class="w-full bg-blue-400 p-2 flex flex-row py-6 gap-2 items-center">
                <div class="brand font-bold mr-8">LOGO APP</div>
                <div class="brand font-bold mr-8">Detail Pemesanan</div>
            </div>
        </navbar>
        <form action="{{ route('main.payment', $id) }}"  method="POST" class="min-h-screen w-full grid grid-cols-2 gap-7 p-4">
            @csrf
            <div class="col-span-1 flex flex-col">
                <div>#{{ $order->number }}</div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="name" class="capitalize">Nama Penerima</label>
                        <input type="text" name="name" id="name" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="phone" class="capitalize">Nomor HP Penerima</label>
                        <input type="text" name="phone" id="phone" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="address" class="capitalize">Alamat</label>
                        <textarea name="address" rows="6" id="address" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-span-1 flex flex-col">
                <div>Detail Pesanan</div>

                <table class="w-100">
                    <thead>
                        <th class="text-left">Nama Produk</th>
                        <th>Kuantiti</th>
                        <th>Harga</th>
                        <th class="text-right">Sub Total</th>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order->detailOrder as $detail)
                            <tr>
                                <td>{{$detail->product->name}}</td>
                                <td class="text-center">{{$detail->qty}}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($detail->product->price, 0, ',', '.')}}</td>
                                <td class="text-right">{{ 'Rp ' . number_format($detail->qty * $detail->price, 0, ',', '.') }}</td>
                            </tr>
                            @php
                                $total += ($detail->qty * $detail->price)
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="w-full flex flex-row items-center justify-end mt-8">
                    <div class="flex-auto text-blue-400 font-bold">
                        Total {{ 'Rp ' . number_format($total, 0, ',', '.') }}
                    </div>
                    <button class="p-2 px-4 rounded-md text-white bg-blue-400">Bayar Sekarang</button>
                </div>
            </div>
        </form>
    </main>
    <footer class="w-full bg-blue-600 p-2">
        Logo Apps
    </footer>
@endsection

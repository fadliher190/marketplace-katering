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
                <div class="brand font-bold mr-8">Detail Tagihan</div>
            </div>
        </navbar>
        <form action="{{ route('main.payment', $id) }}"  method="POST" class="min-h-screen w-full grid grid-cols-2 gap-7 p-4">
            @csrf
            <div class="col-span-1 flex flex-col">
                <div>#{{ $order->number }}</div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="name" class="capitalize">Nama Penerima</label>
                        <input disabled type="text" name="name" id="name" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ $order->name }}">
                    </div>
                </div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="phone" class="capitalize">Nomor HP Penerima</label>
                        <input disabled type="text" name="phone" id="phone" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" value="{{ $order->phone }}">
                    </div>
                </div>
                <div>
                    <div class="flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="address" class="capitalize">Alamat</label>
                        <textarea disabled name="address" rows="6" id="address" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">{{ $order->address }}</textarea>
                    </div>
                </div>
                <div class="mt-4 flex flex-col">
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
                        <tfoot>
                            <tr>
                                <td class="text-left font-bold" colspan="3">Total</td>
                                <td class="text-right">{{ 'Rp ' . number_format($total, 0, ',', '.')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-span-1 flex flex-col">
                <div class="text-center text-blue-400 font-bold text-lg">Terima Kasih Telah Memesan</div>
                <div class="text-center  font-bold text-lg">Silahkan Bayar Sejumlah</div>
                <div class="text-center  font-bold text-blue-400 text-lg">{{ 'Rp ' . number_format($total, 0, ',', '.')}}</div>
                <div class="text-center  font-bold text-lg">Ke Rekening</div>
                <div class="text-center text-blue-400 font-bold text-lg">129xxxxx</div>


            </div>
        </form>
    </main>
    <footer class="w-full bg-blue-600 p-2">
        Logo Apps
    </footer>
@endsection

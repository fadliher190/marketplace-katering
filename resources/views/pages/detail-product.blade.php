@extends('layout.main')
@section('content')
        <div class="min-h-screen w-full grid grid-cols-2 gap-2 p-4">
            <div class="col-span-1">
                <div class="w-full">
                    <img src="{{ asset('storage/'.$product->productImage[0]->src) }}" alt="">
                </div>
            </div>
            <div class="col-span-1 flex flex-col">
                <p class="w-full text-lg font-bold">{{ $product->name }}</p>
                <h1 class="text-lg font-bold text-blue-400">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</h1>
                <form action="{{ route('main.buying') }}" method="POST" class="flex flex-row items-end gap-3 mt-10">
                    @csrf
                    <input type="hidden" name="product" value="{{ $product->getKey() }}">
                    <input type="hidden" name="price" value="{{ $product->getKey() }}">
                    <div class="flex-auto">
                        <div>
                            <label for="qty">Kuantiti</label>
                            <input type="number" name="qty" class="w-full border-2 px-2 py-1 focus:outline-none focus:ring-0" min="1" value="1">
                        </div>
                    </div>
                    <div class="">
                        <button class="p-2 px-6 text-white bg-blue-400">Beli Sekarang</button>
                    </div>
                </form>
            </div>
            <div class="col-span-2 p-4 bg-slate-200 rounded-xl">
                <h1>Deskripsi</h1>
                <p class="w-full">
                    {{ $product->description }}
                </p>
            </div>
        </div>
@endsection

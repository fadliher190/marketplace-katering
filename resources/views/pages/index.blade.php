@extends('layout.main')
@section('content')

        <div class="min-h-screen w-full grid grid-cols-4 gap-2">
            <div class="col-span-1 flex flex-col p-4">
                <span class="flex flex-row items-center gap-3"><i class="fa-solid fa-filter"></i> Filter</span>
                <div class="flex flex-col">
                    <span>Lokasi</span>
                </div>
                <div class="flex flex-col">
                    <span>Batas Harga</span>
                </div>
            </div>
            <div class="col-span-3 bg-slate-100 p-4">
                <div class="w-full grid grid-cols-5 gap-3">
                    @foreach ($products as $product)
                        <div class="col-span-1 overflow-hidden rounded-md border hover border-2 hover:border-blue-600">
                            <a href="{{ route('main.detail', [$product->pluck]) }}" class="w-full  flex flex-col cursor-pointer bg-white">
                                <div class="min-h-42 w-full bg-blue-100 flex flex-col">
                                    <div class="w-full aspect-square">
                                        <img src="{{ asset("storage/".$product->productImage[0]->src) }}" alt="" class="w-full h-full">
                                    </div>
                                </div>
                                <div class="p-2 flex flex-col">
                                    <span>{{ $product->name }}</span>
                                    <span>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</span>
                                    {{-- <span class="text-xs">Lokasi</span> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection

@extends('merchant.layout.app')

@section('title')
    Sign In
@endsection
@section('page-content')
    <main class="w-full min-h-screen flex flex-row">
        <div class="flex-auto bg-blue-400 hidden sm:block"></div>
        <div class="w-1/2 flex items-center justify-center">
            <form action="{{ route('merchant.register.action') }}" method="POST" class="w-full h-full p-7 overflow-y-auto">
                @csrf
                <div class="flex flex-col justify-start">
                    <h1 class="font-bold">Selamat Datang</h1>
                    <small class="text-sm">Silahkan Daftarkan Merchant Terlebih Dahulu</small>
                    <div class="w-full mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="name" class=" text-sm font-semibold capitalize">Nama Merchant</label>
                        <input type="text" name="name" id="name" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                    </div>
                    <div class="w-full mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="phone" class=" text-sm font-semibold capitalize">No HP</label>
                        <input type="text" name="phone" id="phone" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                    </div>
                    <div class="w-full mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="address" class=" text-sm font-semibold capitalize">Alamat</label>
                        <textarea name="address" id="address" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0" rows="5"></textarea>
                    </div>
                    <div class="mt-3">
                        @include('merchant.layout.messages')
                    </div>
                    <div class="w-full flex flex-row mt-3 items-center">
                        <div class="flex-auto">
                            <span class="text-sm">Perlu Bantuan ? <a href="{{ route('auth.sign-up') }}" class="text-blue-600">Klik Disini</a></span>
                        </div>
                        <div>
                            <button class="px-7 py-1 bg-blue-400 font-bold text-white rounded-md">Daftar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

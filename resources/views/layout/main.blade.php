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
                <div class="flex-auto relative overflow-hidden">
                    <form action="" method="GET">
                        <input type="text" inputmode="search" name="keyword" class="w-full px-2 py-1 focus:outline-none focus:ring-0">
                        <button class="px-5 py-1 bg-blue-600 text-white absolute right-0 top-1/2 -translate-y-1/2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="px-8">
                    <a href="" class="text-white block min-h-8 aspect-square relative flex items-center justify-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>
        </navbar>
        @yield('content')
    </main>
    <footer class="w-full bg-blue-600 p-2">
        Logo Apps
    </footer>
@endsection

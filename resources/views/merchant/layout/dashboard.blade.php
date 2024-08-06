@extends('merchant.layout.app')

@section('style-css')
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    @yield('style-css-child')
@endsection
@section('script-js')
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    @yield('script-js-child')
@endsection
@section('title')
    @yield('title')
@endsection
@section('page-content')
    <main class="w-full min-h-screen flex flex-row">
        <div class="flex-1 flex flex-col max-w-80 bg-[#222d32]">
            <div class="h-14 flex items-center p-4 text-white">
                LOGO APP
            </div>
            @include('merchant.layout.sidebar')
        </div>
        <div class="flex-1 flex flex-col">
            <div class="flex-1 max-h-14 flex flex-row items-center p-4">
                @yield("title")
            </div>
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </main>

    @yield('modal')
@endsection

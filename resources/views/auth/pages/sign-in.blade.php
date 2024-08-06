@extends('auth.layout.app')

@section('title')
    Sign In
@endsection
@section('page-content')
    <main class="w-full min-h-screen flex flex-row">
        <div class="flex-auto bg-blue-400 hidden sm:block">
        </div>
        <div class="w-1/2 flex items-center justify-center">

            <form action="{{ route('auth.sign-in.action') }}" method="POST" class="w-full px-7">
                @csrf
                <div class="flex flex-col justify-start">
                    <h1 class="font-bold">Selamat Datang Kembali</h1>
                    <small class="text-sm">Silahkan Masuk Terlebih Dahulu</small>
                    @include('auth.layout.messages')
                    <div class="w-full mt-2 flex flex-col gap-2 min-w-80 sm:min-w-full">
                        <label for="username" class="capitalize">Nama Pengguna</label>
                        <input type="text" name="username" id="username" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                    </div>
                    <div class="w-full mt-2 flex flex-col gap-2 min-w-80">
                        <label for="password" class="capitalize">KataSandi</label>
                        <input type="password" name="password" id="password" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                    </div>
                    <div class="w-full flex flex-row mt-3 items-center">
                        <div class="flex-auto">
                            <a href="#" class="text-blue-600 text-sm">Lupa Kata Sandi</a>
                        </div>
                        <div>
                            <button class="px-2 py-1 bg-blue-400 font-bold text-white rounded-md">Masuk</button>
                        </div>
                    </div>
                    <div class="w-full mt-5">
                        <span class="text-sm">Belum Punya Akun ? <a href="{{ route('auth.sign-up') }}" class="text-blue-600">Daftar Disini</a></span>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@extends('auth.layout.app')

@section('title')
    Sign Up
@endsection
@section('page-content')
    <main class="w-full min-h-screen flex flex-row">
        <div class="sm:w-1/2 w-full flex items-center justify-center">
            <form action="{{ route('auth.sign-up.action') }}" method="POST" class="w-full px-7">
                @csrf
                <div class="flex flex-col justify-start w-full">
                    <h1 class="font-bold">Selamat Datang</h1>
                    <small class="text-sm">Silahkan Daftar Terlebih Dahulu</small>
                    @include('auth.layout.messages')
                    <div class="w-full grid grid-cols-2 gap-x-4">
                        <div class="col-span-1 w-full mt-2 flex flex-col gap-2 min-w-full">
                            <label for="name" class="capitalize">Nama</label>
                            <input type="text" name="name" id="name" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                        </div>
                        <div class="col-span-1 w-full mt-2 flex flex-col gap-2 min-w-full">
                            <label for="username" class="capitalize">Nama Pengguna</label>
                            <input type="text" name="username" id="username" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                        </div>
                        <div class="col-span-2 w-full mt-2 flex flex-col gap-2 min-w-full">
                            <label for="email" class="capitalize">E-mail</label>
                            <input type="email" name="email" id="email" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                        </div>
                        <div class="col-span-1 w-full mt-2 flex flex-col gap-2 min-w-full">
                            <label for="password" class="capitalize">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                        </div>
                        <div class="col-span-1 w-full mt-2 flex flex-col gap-2 min-w-full">
                            <label for="password_confirmation" class="capitalize">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-2 px-2 py-1 rounded-md focus:outline-none focus:ring-0">
                        </div>
                    </div>
                    <div class="w-full flex flex-row mt-3 items-center">
                        <div class="flex-auto">
                            <span class="text-sm">Sudah Punya Akun ? <a href="{{ route('auth.sign-in') }}" class="text-blue-600">Masuk Disini</a></span>
                        </div>
                        <div>
                            <button class="px-4 py-1 bg-blue-400 font-bold text-white rounded-md">Daftar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex-auto bg-blue-400 hidden sm:block"></div>
    </main>
@endsection

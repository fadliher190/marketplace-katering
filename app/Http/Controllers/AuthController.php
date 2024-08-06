<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    public function signIn(){
        return view('auth.pages.sign-in');
    }
    public function signInAction(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    public function signUp(){
        return view('auth.pages.sign-up');
    }
    public function signUpAction(Request $request){
        $validate = Validator::make($request->all(),
        [
            "name" => "required",
            "username" => "required|unique:users,username",
            "email" => "required|unique:users,email",
            "password" => "required|confirmed",
        ],
        [
            "required" => ":attribute tidak boleh kosong",
            "unique" => ":attribute sudah terdaftar",
            "confirmed" => ":attribute tidak sesuai",
        ],
        [
            "name" => "nama",
            "username" => "nama pengguna",
            "password" => "kata sandi",
        ]
        );

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        $user = new User();
        $user->name = $request->post('name');
        $user->username = $request->post('username');
        $user->password = $request->post('password');
        $user->email = $request->post('email');
        $user->save();

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}

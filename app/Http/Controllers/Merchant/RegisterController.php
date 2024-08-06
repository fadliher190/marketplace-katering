<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Merchant;
use App\Models\UserHasMerchant;
use App\Models\MerchantHasAddress;
use DB;
use Auth;

class RegisterController extends Controller
{
    public function index(){
        if (!is_null(Auth::user()->hasMerchant)) {
            return redirect()->to(route('merchant.dashboard'));
        }
        return view('merchant.pages.register');
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),
            [
                "name" => "required|unique:merchants,name",
                "phone" => "required",
                "address" => "required",
            ],
            [
                "required" => ":attribute tidak boleh kosong",
                "unique" => ":attribute sudah terdaftar",
            ],
            [
                "name" => "nama",
                "phone" => "No HP",
                "address" => "Alamat",
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        DB::beginTransaction();
        try {
            $merchant = new Merchant();
            $merchant->name = $request->post("name");
            $merchant->save();

            $userHasMerchant = new UserHasMerchant();
            $userHasMerchant->user_id = Auth::user()->getKey();
            $userHasMerchant->merchant_id = $merchant->getKey();
            $userHasMerchant->save();

            $merchantHasAddress = new MerchantHasAddress();
            $merchantHasAddress->merchant_id = $merchant->getKey();
            $merchantHasAddress->phone = $request->post('phone');
            $merchantHasAddress->address = $request->post('address');
            $merchantHasAddress->save();

            DB::commit();
            Auth::logout();
            return redirect()->to(route('merchant.dashboard'))->with('success', "Silahkan Masuk Kembali");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage());
        }


    }
}

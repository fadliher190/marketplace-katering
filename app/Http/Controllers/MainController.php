<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
use DB;
use Exception;

class MainController extends Controller
{
    public  function index(){
        $products = Product::paginate(20);
        return view('pages.index', compact('products'));
    }
    public  function detail($pluck){
        $product = Product::wherePluck($pluck)->first();
        return view('pages.detail-product', compact('product'));
    }
    public function buying(Request $request){
        DB::beginTransaction();
        try {
            $product = Product::find($request->post('product'));

            $prefix = "ORDER-". str_pad($product->merchant_id, 4, "0", STR_PAD_LEFT) . "-" . date("dmy"). "-";
            $numberOrder = Order::where('merchant_id', $product->merchant_id)->latest();
            if(!isset($numberOrder) && is_null($numberOrder)){
                $numberOrder = $prefix . str_pad('1', 4, "0", STR_PAD_LEFT);
            }else{
                $numberOrder = $numberOrder->first()->number;
                $number = (int) substr($numberOrder, strlen($prefix));
                $number += 1;
                $numberOrder = $prefix . str_pad($number, 4, "0", STR_PAD_LEFT);
            }
            $order = new Order();
            $order->number = $numberOrder;
            $order->merchant_id = $product->merchant_id;
            $order->user_id = Auth::user()->getKey();
            $order->name = "";
            $order->phone = "";
            $order->address = "";
            $order->status = 0;
            $order->save();

            $detailOrder = new DetailOrder();
            $detailOrder->order_id = $order->getKey();
            $detailOrder->product_id = $product->getKey();
            $detailOrder->name = $product->name;
            $detailOrder->qty = $request->post('qty');
            $detailOrder->price = $product->price;
            $detailOrder->save();
            DB::commit();
            return redirect()->to(route('main.detail-order', $order->getKey()));

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back();
        }
    }

    function detailOrder($orderId){
        $order = Order::find($orderId);
        return view('pages.detail-order', ["id" => $orderId, "order" => $order]);
    }
    function payment(Request $request, $orderId){
        $order = Order::find($orderId);
        $order->name = $request->post('name');
        $order->phone = $request->post('phone');
        $order->address = $request->post('address');
        $order->save();
        return view('pages.bill', ["id" => $orderId, "order" => $order]);
    }
}

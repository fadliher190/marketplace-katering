<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Product;
use App\Models\ProductImage;
use Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('merchant.pages.master.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merchant.pages.master.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(),
            [
                "name" => "required",
                "price" => "required",
            ],
            [
                "required" => ":attribute tidak boleh kosong",
            ],
            [
                "name" => "nama",
                "price" => "harga",
            ]
        );

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        try {
            $merchant_id = Auth::user()->hasMerchant->merchant_id;
            $product = new Product();
            $product->merchant_id = $merchant_id;
            $product->pluck = str_replace(" ", "-", $request->post('name')) ."-". $merchant_id;
            $product->name = $request->post('name');
            $product->price = $request->post('price');
            $product->description = $request->post('description');
            $product->save();

            $images = $request->post('imagePost');
            foreach ($images as $key => $value) {
                if(!is_null($value)){
                    $imageParts = explode(";base64,", $value);
                    $imageType = explode("image/", $imageParts[0])[1];
                    $imageBase64 = base64_decode($imageParts[1]);
                    $pathFile = "product/";
                    $fileName = $pathFile . "PRD-". str_pad($merchant_id, 4, "0", STR_PAD_LEFT) ."-". str_pad($product->getKey(), 4, "0", STR_PAD_LEFT) . '.' . $imageType;
                    Storage::disk('public')->put($fileName, $imageBase64);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->getKey();
                    $productImage->src = $fileName;
                    $productImage->save();
                }
            }

            return redirect()->to(route('merchant.product.index'));

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([$th->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

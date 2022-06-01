<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\Product;

class ProductCartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $email = $request->input('email');
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');

        $productDetails = Product::where('product_code', $product_code)->get();

        $price = $productDetails[0]['price'];
        $special_price = $productDetails[0]['special_price'];

        if ($special_price == '') {
            $total_price = floatval($price) * intval($quantity);
            $unit_price = $price;
        } else {
            $total_price = floatval($special_price) * intval($quantity);
            $unit_price = $special_price;
        }

        $result = ProductCart::insert([

            'email' => $email,
            'product_image' => $productDetails[0]['image'],
            'product_name' => $productDetails[0]['name'],
            'product_code' => $productDetails[0]['product_code'],
            'size' =>  $size,
            'color' => $color,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_price' => $total_price,

        ]);

        return $result;
    }

    public function CartCount(Request $request)
    {
        // $product_code = $request->product_code;
        $email = $request->email;
        $result = ProductCart::where('email', $email)->count();
        return $result;
    }

    public function CartList(Request $request)
    {

        $email = $request->email;
        $result = ProductCart::where('email', $email)->get();
        return $result;
    }
    public function RemoveCartList(Request $request)
    {

        $id = $request->id;
        $result = ProductCart::where('id', $id)->delete();
        return $result;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorites;


class FavoriteController extends Controller
{
    public function AddFavorite(Request $request)
    {

        $product_code = $request->product_code;
        $email = $request->email;
        $productDetails = Product::where('product_code', $product_code)->get();

        $result = Favorites::insert([

            'product_id' => $productDetails[0]['id'],
            'product_name' => $productDetails[0]['name'],
            'image' => $productDetails[0]['image'],
            'product_code' => $product_code,
            'subcategory' => $productDetails[0]['subcategory'],
            'email' => $email,

        ]);
        return $result;
    }

    public function FavoriteList(Request $request)
    {

        $email = $request->email;
        $result = Favorites::where('email', $email)->get();
        return $result;
    }

    public function FavoriteRemove(Request $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;

        $result = Favorites::where('product_code', $product_code)->where('email', $email)->delete();
        return $result;
    }
}

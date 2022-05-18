<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\Product;

class ProductDetailsController extends Controller
{
    public function ProductDetails(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id', $id)->get();
        $productDetails = ProductDetails::where('product_id', $id)->get();

        $item = [
            'product' => $product,
            'productDetails' => $productDetails,
        ];
        return $item;
    }
}

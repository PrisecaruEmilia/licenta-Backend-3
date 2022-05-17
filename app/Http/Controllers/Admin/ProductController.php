<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remark = $request->remark;
        $productList  = Product::where('remark', trim($remark))->get();
        return $productList;
    }

    public function ProductListByCategory(Request $request)
    {
        $category = $request->category;
        $productList  = Product::where('category', trim($category))->get();
        return $productList;
    }
    public function ProductListBySubcategory(Request $request)
    {
        $category = $request->category;
        $subcategory = $request->subcategory;
        $productList  = Product::where('category', trim($category))->where('subcategory', trim($subcategory))->get();
        return $productList;
    }
}

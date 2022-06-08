<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Image;

class ProductController extends Controller
{
    public function AllProductList()
    {
        $productList  = Product::all();
        return $productList;
    }
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

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $productList = Product::where('name', 'LIKE', "%{$key}%")->orWhere('brand', 'LIKE', "%{$key}%")->get();
        return $productList;
    }

    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productList = Product::where('subcategory', $subcategory)->orderBy('id', 'desc')->limit(8)->get();
        return $productList;
    }

    public function GetProductByCode(Request $request)
    {
        $product_code = $request->product_code;
        $result = Product::where('product_code', $product_code)->get();
        return $result;
    }

    public function GetAllProduct()
    {

        $products = Product::latest()->paginate(10);
        return view('backend.product.product_all', compact('products'));
    }
    public function AddProduct()
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        return view('backend.product.product_add', compact('category', 'subcategory'));
    }
}

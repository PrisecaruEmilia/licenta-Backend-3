<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetails;
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

    public function StoreProduct(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'remark' => 'required',
            'brand' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'image_one' => 'required',
            'image_two' => 'required',
            'image_three' => 'required',
            'image_four' => 'required',
            'short_description' => 'required',
            'color' => 'required',
            'size' => 'required',
            'qty' => 'required',
            'long_description' => 'required',

        ], [
            'name.required' => 'Nume este obligatoriu',
            'price.required' => 'Preț este obligatoriu',
            'image.required' => 'Imagine este obligatoriu',
            'category.required' => 'Categorie este obligatoriu',
            'subcategory.required' => 'Subcategorie câmp este obligatoriu',
            'remark.required' => 'Remark este obligatoriu',
            'brand.required' => 'Brand este obligatoriu',
            'product_code.required' => 'Code este obligatoriu',
            'product_code.unique' => 'Există deja acest product code',
            'image_one.required' => 'Imagine 1 este obligatoriu',
            'image_two.required' => 'Imagine 2 este obligatoriu',
            'image_three.required' => 'Imagine 3 este obligatoriu',
            'image_four.required' => 'Imagine 4 este obligatoriu',
            'short_description.required' => 'Scurtă descriere este obligatoriu',
            'color.required' => 'Culoare este obligatoriu',
            'size.required' => 'Mărime câmp este obligatoriu',
            'qty.required' => 'Cantitate este obligatoriu',
            'long_description.required' => 'Descriere Lungă este obligatoriu',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(500, 500)->save('upload/product/' . $name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/product/' . $name_gen;

        $product_slug = strtolower($request->name);

        $product_id = Product::insertGetId([
            'name' => $request->name,
            'slug' => str_replace(" ", "-", $product_slug),
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        /////// Insert Into Product Details Table //////
        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        Image::make($image1)->resize(500, 500)->save('upload/product_details/' . $name_gen1);
        $save_url1 = 'http://127.0.0.1:8000/upload/product_details/' . $name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
        Image::make($image2)->resize(500, 500)->save('upload/product_details/' . $name_gen2);
        $save_url2 = 'http://127.0.0.1:8000/upload/product_details/' . $name_gen2;


        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
        Image::make($image1)->resize(500, 500)->save('upload/product_details/' . $name_gen3);
        $save_url3 = 'http://127.0.0.1:8000/upload/product_details/' . $name_gen3;



        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
        Image::make($image4)->resize(500, 500)->save('upload/product_details/' . $name_gen4);
        $save_url4 = 'http://127.0.0.1:8000/upload/product_details/' . $name_gen4;

        if ($request->qty > 0) {
            $product_is_available = 'da';
        } else {
            $product_is_available = 'nu';
        }
        $product_long_description = str_replace("<p>", "", $request->long_description);
        $product_long_description = str_replace("</p>", "", $product_long_description);

        ProductDetails::insert([
            'product_id' => $product_id,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'qty' =>  $request->qty,
            'available' =>  $product_is_available,
            'long_description' => $product_long_description,

        ]);


        $notification = array(
            'message' => 'Produs inserat cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }
}

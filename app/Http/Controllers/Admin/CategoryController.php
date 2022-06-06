<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::all();
        $categoryDetails = [];
        foreach ($categories as $value) {
            $subcategory = Subcategory::where('category_name', $value['category_name'])->get();
            $item = [
                'category_name' => $value['category_name'],
                'category_image' => $value['category_image'],
                'subcategories' => $subcategory
            ];
            array_push($categoryDetails, $item);
        }
        return $categoryDetails;
    }

    public function GetAllCategory()
    {

        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function AddCategory()
    {
        return view('backend.category.category_add');
    }


    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ], [
            'category_name.required' => 'Câmpul nume categorie este obligatoriu'

        ]);

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(500, 500)->save('upload/category/' . $name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/category/' . $name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Categoria a fost inserată cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;

        if ($request->file('category_image')) {

            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 500)->save('upload/category/' . $name_gen);
            $save_url = 'http://127.0.0.1:8000/upload/category/' . $name_gen;

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Categoria a fost editată cu succes - cu imagine',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } else {

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,

            ]);

            $notification = array(
                'message' => 'Categoria a fost editată cu succes - fără imagine',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        }
    }
    public function DeleteCategory($id)
    {

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Categoria a fost ștearsă cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

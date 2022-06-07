<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Image;

class HomeSliderController extends Controller
{
    public function AllSliderDetails()
    {
        $result = HomeSlider::all();
        return $result;
    }

    public function GetAllSlider()
    {
        $slider = HomeSlider::latest()->get();
        return view('backend.slider.slider_view', compact('slider'));
    }


    public function AddSlider()
    {

        return view('backend.slider.slider_add');
    }

    public function StoreSlider(Request $request)
    {

        $request->validate([
            'slider_image' => 'required',
        ], [
            'slider_image.required' => 'Acest câmp este obligatoriu'

        ]);

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(500, 500)->save('upload/slider/' . $name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/slider/' . $name_gen;

        HomeSlider::insert([
            'slider_image' => $save_url,
            'slider_text' => '<h2>Nu sunt doar pantofi<br />Ei sunt <span>Investiții</span> </h2> <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam voluptatibus perferendis nesciunt non doloribus perspiciatis veritatis harum corrupti eius commodi! </p>',
            'slider_color' => '#ffffff'
        ]);

        $notification = array(
            'message' => 'Slider inserat cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }
}

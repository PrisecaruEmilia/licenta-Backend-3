<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\CartOrder;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmOrderMail;


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

        $productMoreDetails = ProductDetails::where('product_id', $productDetails[0]['id'])->get();
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
            'max_quantity' => $productMoreDetails[0]['qty'],
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

    public function CartItemPlus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        // $product_code = $request->product_code;
        // $product = Product::where('product_code', $product_code)->get();
        // $productMaxQty = ProductDetails::where('product_id', $product->id)->get();

        $newQuantity = intval($quantity) + 1;

        $total_price = intval($newQuantity) * floatval($price);
        $result = ProductCart::where('id', $id)->update(['quantity' => $newQuantity, 'total_price' => $total_price]);

        return $result;
    }

    public function CartItemMinus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $newQuantity = intval($quantity) - 1;
        $total_price = intval($newQuantity) * floatval($price);
        $result = ProductCart::where('id', $id)->update(['quantity' => $newQuantity, 'total_price' => $total_price]);

        return $result;
    }

    public function CartOrder(Request $request)
    {
        $city = $request->input('city');
        $paymentMethod = $request->input('payment_method');
        $userName = $request->input('name');
        $email = $request->input('email');
        $DeliveryAddress = $request->input('delivery_address');
        $invoice_no = $request->input('invoice_no');
        $deliveryCharge = $request->input('delivery_charge');

        date_default_timezone_set('Europe/Bucharest');
        $request_time = date("h:i:sa");
        $request_date = date("d-m-Y");

        $CartList = ProductCart::where('email', $email)->get();
        $cartInsertDeleteResult = 0;
        foreach ($CartList as $CartListItem) {
            // $cartInsertDeleteResult = "";

            $resultInsert = CartOrder::insert([
                'invoice_no' => "SplashShop" . $invoice_no,
                'product_name' => $CartListItem['product_name'],
                'product_code' => $CartListItem['product_code'],
                'size' => $CartListItem['size'],
                'color' => $CartListItem['color'],
                'quantity' => $CartListItem['quantity'],
                'unit_price' => $CartListItem['unit_price'],
                'total_price' => $CartListItem['total_price'],
                'email' => $CartListItem['email'],
                'name' => $userName,
                'payment_method' => $paymentMethod,
                'delivery_address' => $DeliveryAddress,
                'city' => $city,
                'delivery_charge' => $deliveryCharge,
                'order_date' => $request_date,
                'order_time' => $request_time,
                'order_status' => "Pending",
            ]);

            if ($resultInsert == 1) {
                $resultDelete = ProductCart::where('id', $CartListItem['id'])->delete();
                $productDetails = Product::where('product_code', $CartListItem['product_code'])->get();

                $productMoreDetails = ProductDetails::where('product_id', $productDetails[0]['id'])->get();

                $updateQty = intval($productMoreDetails[0]['qty']) - intval($CartListItem['quantity']);
                ProductDetails::where('product_id', $productDetails[0]['id'])->update(['qty' => $updateQty]);

                if ($resultDelete == 1) {
                    $cartInsertDeleteResult = 1;
                } else {
                    $cartInsertDeleteResult = 0;
                }
            }
        }

        // Mail Send to User
        $orders = CartOrder::where('invoice_no', "SplashShop" . $invoice_no)->get();
        foreach ($orders as $order) {
            Mail::to($email)->send(new ConfirmOrderMail($order));
        }
        return $cartInsertDeleteResult;
    }

    public function OrderListByUser(Request $request)
    {
        $email = $request->email;
        $result = CartOrder::where('email', $email)->orderBy('id', 'DESC')->get();
        return $result;
    }

    public function PendingOrder()
    {

        $orders = CartOrder::where('order_status', 'Pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function ProcessingOrder()
    {

        $orders = CartOrder::where('order_status', 'Processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    }


    public function CompleteOrder()
    {

        $orders = CartOrder::where('order_status', 'Complete')->orderBy('id', 'DESC')->get();
        return view('backend.orders.complete_orders', compact('orders'));
    }

    public function OrderDetails($id)
    {

        $order = CartOrder::findOrFail($id);
        if ($order->payment_method === 'cash_on_delivery') {
            CartOrder::findOrFail($id)->update(['payment_method' => 'Cash la livrare']);
        }
        return view('backend.orders.order_details', compact('order'));
    }

    public function PendingToProcessing($id)
    {

        CartOrder::findOrFail($id)->update(['order_status' => 'Processing']);

        $notification = array(
            'message' => 'Comand?? procesat?? cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    } // End Method


    public function ProcessingToComplete($id)
    {

        CartOrder::findOrFail($id)->update(['order_status' => 'Complete']);

        $notification = array(
            'message' => 'Comand?? procesat?? cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->route('processing.order')->with($notification);
    }

    public function DeleteCartOrder($id)
    {
        CartOrder::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Comand?? ??tears?? cu succes!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

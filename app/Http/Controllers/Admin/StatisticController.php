<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartOrder;
use App\Models\Contact;
use App\Models\Visitor;
use App\Models\ProductReview;



class StatisticController extends Controller
{
    public function Statistic()
    {
        $totalMessages = Contact::count();
        $totalOrders = CartOrder::count();
        $totalVisitors = Visitor::count();
        $ordersRevenue = CartOrder::get();
        $totalRevenue = 0;
        foreach ($ordersRevenue as $item) {
            $totalRevenue = $totalRevenue + $item->total_price;
        }
        $orders = CartOrder::orderBy('id', 'DESC')->limit(10)->get();
        $reviews = ProductReview::orderBy('id', 'DESC')->limit(10)->get();

        return view('admin.index', compact('orders', 'reviews', 'totalOrders', 'totalMessages', 'totalVisitors', 'totalRevenue'));
    }
}

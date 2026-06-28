<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of user orders
     */
    public function my_order()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.order.my_order', compact('orders'));
    }

    /**
     * Display order details
     */
    public function order_details($orderId)
    {
        $order = Order::with(['orderItems.product', 'orderItems.product.images'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.order.order_details', compact('order'));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Lấy tất cả các đơn hàng của người dùng hiện tại
        $orders = Order::with('items')->where('user_id', Auth::id())->get();
        return view('client.layouts.orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
    
        // Kiểm tra trạng thái đơn hàng trước khi hủy
        if ($order->status == 'pending' || $order->status == 'waiting for delivery') {
            $order->status = 'cancelled';
            $order->save();
            return redirect()->route('orders.index')->with('status', 'Order cancelled successfully!');
        }
    
    }
    

}

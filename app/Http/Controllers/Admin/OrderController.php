<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        // Lấy tất cả đơn hàng
        $orders = Order::all();

        // Truyền dữ liệu vào view
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết đơn hàng từ bảng order_detail
        $orderDetails = OrderDetail::where('order_id', $id)->get();

        // Truyền dữ liệu vào view
        return view('admin.orders.show', compact('orderDetails'));
    }
}

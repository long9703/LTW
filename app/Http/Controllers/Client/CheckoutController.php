<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // CartController.php
    public function showCheckoutPage()
    {
        // Lấy cart items kèm luôn product
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }
        $shippingFee = 30000;
        $totalMoney = $subtotal + $shippingFee - 30000;
       

        return view('checkout', compact('cartItems', 'subtotal', 'shippingFee', 'totalMoney'));
    }



    public function addToCart($productId, $quantity)
    {
        $cart = auth()->Auth::user()->carts;

        // Kiểm tra nếu giỏ hàng không tồn tại, tạo mới
        if (!$cart) {
            $cart = auth()->Auth::user()->carts()->create();  // Tạo giỏ hàng nếu chưa có
        }

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có, tạo mới
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('checkout');  // Quay lại trang thanh toán
    }

    // Xử lý thanh toán
    public function processCheckout(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Tạo đơn hàng mới
            $order = Order::create([
                'user_id' => Auth::id(),
                'fullname' => $request->fullname,
                'email' => Auth::user()->email,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'order_date' => now(),
                'status' => 'pending', // Đơn hàng mới tạo có thể là 'pending'
                'total_money' => $request->totalMoney, 
            ]);

            // Lưu chi tiết đơn hàng
            foreach (Auth::user()->cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'num' => $item->quantity,
                    'total_money' => $item->product->price * $item->quantity,
                ]);
            }

            // Xóa giỏ hàng sau khi hoàn tất đặt hàng
            Auth::user()->cartItems()->delete();

            // Commit transaction
            DB::commit();

            return redirect()->back()->with('success', 'Đặt hàng thành công! Hãy tiếp tục mua sắm');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout error: ' . $e->getMessage()); // Ghi log lỗi
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại.', 'error' => $e->getMessage()]);
        }
    }
}

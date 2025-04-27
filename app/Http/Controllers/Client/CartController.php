<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product; 
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        // Lấy thông tin sản phẩm từ bảng products
        $product = Product::findOrFail($productId);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Nếu đã có thì chỉ cập nhật số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có thì thêm mới, lấy luôn giá và hình ảnh hiện tại
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'product_image' => $product->image, // giả sử cột hình là 'image' trong bảng products
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }
    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        
        // Cập nhật số lượng mới
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }
    public function index()
    {
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'subtotal'));
    }
}

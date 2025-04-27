<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        // Lấy danh mục (nếu cần)
        $categories = Category::all();

        // Lọc sản phẩm theo giá và danh mục (nếu có)
        $products = Product::query();

        if ($request->has('category')) {
            $products->where('category_id', $request->category);
        }

        if ($request->has('price')) {
            $products->where('price', '<=', $request->price);
        }

        // Phân trang sản phẩm
        $products = $products->paginate(6);

        return view('product', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }
    //tim kiem san pham
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', '%' . $query . '%')->get();

        return view('product_search', compact('products', 'query'));
    }
}

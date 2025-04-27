@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Chi tiết sản phẩm: {{ $product->name }}</h2>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>Tên sản phẩm</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <th>Giá</th>
                <td>{{ number_format($product->price, 2) }} VND</td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td>{{ $product->quantity }}</td>
            </tr>
            <tr>
                <th>Hình ảnh</th>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200">
                    @else
                        Không có hình ảnh
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Chỉnh sửa</a>
    </div>
@endsection

<!-- admin/orders/details.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Order Details</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td> <!-- Nếu bạn có quan hệ giữa order_detail và sản phẩm -->
                    <td>{{ number_format($detail->price, 2) }}</td>
                    <td>{{ $detail->num }}</td>
                    <td>{{ number_format($detail->total_money, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
@endsection

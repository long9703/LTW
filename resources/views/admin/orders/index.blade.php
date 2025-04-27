@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manage Orders</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Total Money</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->fullname }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ number_format($order->total_money, 2) }} VND</td>
                <td>{{ $order->order_date }}</td>
                <td>
                    <!-- Dropdown to change order status -->
                    <form action="{{ route('admin.orders.updateStatus', ['order' => $order->id]) }}" method="POST">

                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>

                </td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
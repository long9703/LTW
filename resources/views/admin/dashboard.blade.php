@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 id="total-revenue">${{ number_format($totalRevenue, 2) }}</h2>
                    <p class="mb-0">This month's revenue</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <h2 id="total-products">{{ $totalProducts }}</h2>
                    <p class="mb-0">Items in stock</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h2 id="total-orders">{{ $totalOrders }}</h2>
                    <p class="mb-0">Orders processed</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2 id="total-users">{{ $totalUsers }}</h2>
                    <p class="mb-0">Registered users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Sales Overview</div>
                <div class="card-body">
                    <canvas id="salesChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Order Status</div>
                <div class="card-body">
                    <canvas id="orderStatusChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesDates = @json($salesDates); // chuẩn
    const salesData = @json($salesData);
    const orderStatusData = @json(array_values($orderStatusData));



    // Sales Chart
    const salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: salesDates, // -> hiển thị ngày
            datasets: [{
                label: 'Revenue ($)',
                data: salesData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 10 // nếu quá nhiều ngày thì chỉ hiển thị 10 mốc
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Order Status Chart
    const orderStatusChart = new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed','Pending','Cancelled'],
            datasets: [{
                label: 'Orders',
                data: orderStatusData,
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
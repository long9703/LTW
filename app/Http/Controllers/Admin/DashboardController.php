<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ví dụ query dữ liệu từ DB
        $sales = Order::selectRaw('DATE(created_at) as date, SUM(total_money) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $salesDates = $sales->pluck('date')->toArray(); // Mảng các ngày
        $salesData = $sales->pluck('total')->toArray(); // Mảng doanh thu

        $orderStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $defaultStatus = [
            'completed' => 0,
            'pending' => 0,
            'cancelled' => 0,
        ];

        $orderStatus = array_merge($defaultStatus, array_change_key_case($orderStatus, CASE_LOWER));

        return view('admin.dashboard', [
            'totalRevenue' => Order::sum('total_money'),
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'salesDates' => $salesDates,
            'salesData' => $salesData,
            'orderStatusData' => $orderStatus,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Perfume;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => User::where('role', 'customer')->count(),
            'orders' => Order::count(),
            'products' => Perfume::count(),
            'low_stock' => Perfume::where('stock', '<=', 5)->count(),
        ];

        $recentOrders = Order::latest()->take(8)->get();
        $lowStockPerfumes = Perfume::where('stock', '<=', 5)->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockPerfumes'));
    }
}

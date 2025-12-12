<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        // Key Statistics
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalUsers = \App\Models\User::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Recent Orders (last 5)
        $recentOrders = Order::latest()->take(5)->get();

        // Orders by Status
        $ordersByStatus = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'pendingOrders',
            'recentOrders',
            'ordersByStatus'
        ));
    }

    public function showOrder(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function services()
    {
        return "Manage Services Page (Coming Soon)";
    }

    public function portfolio()
    {
        return "Manage Portfolio Page (Coming Soon)";
    }
}

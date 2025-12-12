<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('customer_email', $user->email)
            ->latest()
            ->paginate(10);

        return view('user.dashboard', compact('user', 'orders'));
    }
}

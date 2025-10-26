<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats()
    {
        $orders = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total_price');
        $pending = Order::where('status', 'pending')->count();
        $customers = Order::distinct('customer_name')->count('customer_name');

        return response()->json([
            'orders' => $orders,
            'revenue' => $revenue,
            'pending' => $pending,
            'customers' => $customers,
            'ordersChange' => '+12', // bisa diatur dinamis nanti
            'revenueChange' => '+8',
            'customersChange' => '+15',
            'avgWaitTime' => 15
        ]);
    }

    public function menuItems()
    {
        $menu = MenuItem::all();
        return response()->json($menu);
    }
}

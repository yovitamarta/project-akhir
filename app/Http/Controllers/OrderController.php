<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Order::create([
            'user_id' => Auth::id(),
            'menu' => $request->menu,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => ''
        ]);

        return redirect()->route('orders.user')->with('success', 'Pesanan berhasil dibuat!');
    }
}

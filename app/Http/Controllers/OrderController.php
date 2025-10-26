<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Ambil semua pesanan
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    // Tambah pesanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'items' => 'required|array',
            'total_price' => 'required|numeric|min:0',
        ]);

        $validated['order_code'] = 'ORD-' . strtoupper(Str::random(6));
        $validated['status'] = 'pending';

        $order = Order::create($validated);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    // Lihat detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Order status updated',
            'order' => $order
        ]);
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}

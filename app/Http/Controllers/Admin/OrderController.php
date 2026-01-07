<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user', 'items.lensType', 'items.lensCoating']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);
        $order->status = $request->status;
        if ($request->has('payment_status')) {
            $order->payment_status = $request->payment_status;
        }
        $order->save();

        return back()->with('success', 'Order status updated.');
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return back()->with('success', 'Order removed successfully.');
    }
}

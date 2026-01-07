<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = \App\Models\Order::where('payment_status', 'paid')->sum('total');
        $activeOrders = \App\Models\Order::whereNotIn('status', ['delivered', 'cancelled'])->count();
        $totalProducts = \App\Models\Product::count();
        $totalUsers = \App\Models\User::count();
        $recentOrders = \App\Models\Order::with('user')->latest()->limit(5)->get();

        // Chart Data: Revenue for last 7 days
        $revenueData = [];
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueLabels[] = $date->format('D');
            $revenueData[] = \App\Models\Order::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->sum('total');
        }

        // Chart Data: Order Distribution
        $orderDist = [
            'delivered' => \App\Models\Order::where('status', 'delivered')->count(),
            'processing' => \App\Models\Order::where('status', 'processing')->count(),
            'pending' => \App\Models\Order::where('status', 'pending')->count(),
            'cancelled' => \App\Models\Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalRevenue',
            'activeOrders',
            'totalProducts',
            'totalUsers',
            'recentOrders',
            'revenueLabels',
            'revenueData',
            'orderDist'
        ));
    }
}

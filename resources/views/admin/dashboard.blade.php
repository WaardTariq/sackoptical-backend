@extends('admin.layouts.master')

@section('content')
    <div class="dashboard-premium">
        <!-- Animated Background -->
        <div class="dashboard-bg-overlay"></div>

        <div class="container-fluid position-relative" style="z-index: 1;">

            <!-- Hero Header with Typing Effect -->
            <div class="dashboard-hero mb-5 animate-fade-in-down">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-2 text-white typing-text">Welcome to Sacks Optical</h1>
                        <p class="lead text-white-50 mb-0">Your premium eyewear management dashboard</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-outline-light btn-lg rounded-pill px-4 magnetic-btn glow-on-hover">
                            <i class="fa-solid fa-download me-2"></i> Export Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Premium Stats Cards with 3D Effect -->
            <div class="row g-4 mb-5">
                <!-- Total Revenue -->
                <div class="col-xl-3 col-md-6 animate-on-scroll reveal-on-scroll">
                    <div class="stat-card-premium stat-card-3d black-card">
                        <div class="stat-card-inner">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="fa-solid fa-sack-dollar stat-icon"></i>
                            </div>
                            <div class="stat-content">
                                <p class="stat-label">TOTAL REVENUE</p>
                                <h2 class="stat-value">$<span class="counter-number"
                                        data-target="{{ $totalRevenue }}">{{ number_format($totalRevenue, 0) }}</span></h2>
                                <div class="stat-trend positive">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <span>Real-time earnings</span>
                                </div>
                            </div>
                            <div class="stat-sparkline"></div>
                        </div>
                    </div>
                </div>

                <!-- Active Orders -->
                <div class="col-xl-3 col-md-6 animate-on-scroll reveal-on-scroll" style="animation-delay: 0.1s;">
                    <div class="stat-card-premium stat-card-3d white-card">
                        <div class="stat-card-inner">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="fa-solid fa-box-open stat-icon"></i>
                            </div>
                            <div class="stat-content">
                                <p class="stat-label">ACTIVE ORDERS</p>
                                <h2 class="stat-value"><span class="counter-number"
                                        data-target="{{ $activeOrders }}">{{ $activeOrders }}</span></h2>
                                <div class="stat-trend neutral">
                                    <i class="fa-solid fa-truck"></i>
                                    <span>Processing now</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Products -->
                <div class="col-xl-3 col-md-6 animate-on-scroll reveal-on-scroll" style="animation-delay: 0.2s;">
                    <div class="stat-card-premium stat-card-3d black-card">
                        <div class="stat-card-inner">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="fa-solid fa-glasses stat-icon"></i>
                            </div>
                            <div class="stat-content">
                                <p class="stat-label">TOTAL PRODUCTS</p>
                                <h2 class="stat-value"><span class="counter-number"
                                        data-target="{{ $totalProducts }}">{{ $totalProducts }}</span></h2>
                                <div class="stat-trend negative">
                                    <i class="fa-solid fa-glasses"></i>
                                    <span>Catalog size</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="col-xl-3 col-md-6 animate-on-scroll reveal-on-scroll" style="animation-delay: 0.3s;">
                    <div class="stat-card-premium stat-card-3d white-card">
                        <div class="stat-card-inner">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="fa-solid fa-users stat-icon"></i>
                            </div>
                            <div class="stat-content">
                                <p class="stat-label">CUSTOMERS</p>
                                <h2 class="stat-value"><span class="counter-number"
                                        data-target="{{ $totalUsers }}">{{ $totalUsers }}</span></h2>
                                <div class="stat-trend positive">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <span>Registered users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-5">
                <div class="col-lg-8 animate-on-scroll reveal-on-scroll">
                    <div class="premium-card glass-card">
                        <div class="card-header-premium">
                            <h5 class="mb-0 fw-bold">Revenue Analytics</h5>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-dark active">Week</button>
                                <button class="btn btn-outline-dark">Month</button>
                                <button class="btn btn-outline-dark">Year</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart" height="80"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 animate-on-scroll reveal-on-scroll">
                    <div class="premium-card glass-card">
                        <div class="card-header-premium">
                            <h5 class="mb-0 fw-bold">Order Distribution</h5>
                        </div>
                        <div class="card-body text-center">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row g-4">
                <div class="col-12 animate-on-scroll reveal-on-scroll">
                    <div class="premium-card glass-card">
                        <div class="card-header-premium">
                            <h5 class="mb-0 fw-bold">Recent Orders</h5>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-gold text-decoration-none fw-bold magnetic-btn">
                                View All <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-premium mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr class="table-row-animated">
                                            <td class="fw-bold">#{{ $order->order_number }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-premium">
                                                        {{ substr($order->user->name ?? 'G', 0, 1) }}{{ substr(explode(' ', $order->user->name ?? 'U')[1] ?? '', 0, 1) }}
                                                    </div>
                                                    <span>{{ $order->user->name ?? 'Guest User' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($order->items->count() > 0)
                                                    {{ $order->items->first()->product_name }}
                                                    @if($order->items->count() > 1)
                                                        <small class="text-muted">(+{{ $order->items->count() - 1 }} more)</small>
                                                    @endif
                                                @else
                                                    No items
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = 'badge-info';
                                                    if ($order->status == 'delivered')
                                                        $badgeClass = 'badge-success';
                                                    if ($order->status == 'cancelled')
                                                        $badgeClass = 'badge-danger';
                                                    if ($order->status == 'processing')
                                                        $badgeClass = 'badge-warning';
                                                @endphp
                                                <span
                                                    class="badge-premium {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-dark rounded-pill magnetic-btn">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-white-50">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Premium Dashboard Styles - Black & White Theme */
        .dashboard-premium {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
            position: relative;
            padding: 2rem 0;
        }

        .dashboard-bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 50%, rgba(24, 24, 24, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Hero Section */
        .dashboard-hero {
            padding: 2rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Premium Stat Cards */
        .stat-card-premium {
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .stat-card-3d {
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }

        .black-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .white-card {
            background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .stat-card-inner {
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .stat-icon-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            margin-bottom: 1.5rem;
        }

        .stat-icon-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            border-radius: 16px;
            opacity: 0.2;
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .stat-icon {
            position: relative;
            font-size: 2rem;
            color: #d4af37;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .black-card .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 0.5rem;
        }

        .white-card .stat-label {
            color: rgba(0, 0, 0, 0.6);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 0.5rem;
        }

        .black-card .stat-value {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
        }

        .white-card .stat-value {
            color: #000000;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .stat-trend {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-trend.positive {
            color: #10b981;
        }

        .stat-trend.negative {
            color: #ef4444;
        }

        .stat-trend.neutral {
            color: #6b7280;
        }

        /* Glass Card Effect */
        .premium-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .card-header-premium {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #ffffff;
        }

        .premium-card .card-body {
            padding: 2rem;
        }

        /* Premium Table */
        .table-premium {
            color: #ffffff;
        }

        .table-premium thead th {
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 1rem;
        }

        .table-premium tbody td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1rem;
            vertical-align: middle;
        }

        .table-row-animated {
            transition: all 0.3s ease;
        }

        .table-row-animated:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: scale(1.01);
        }

        /* Avatar */
        .avatar-premium {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
        }

        /* Badges */
        .badge-premium {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        /* Animations */
        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.05);
            }
        }

        .wave-letter {
            display: inline-block;
            animation: wave 1.5s ease-in-out infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Ripple Effect */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Reveal Animation */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .text-gold {
            color: #d4af37 !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/dashboard-animations.js') }}"></script>
    <script>
        // Charts
        document.addEventListener('DOMContentLoaded', () => {
            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: @json($revenueLabels),
                        datasets: [{
                            label: 'Revenue',
                            data: @json($revenueData),
                            borderColor: '#d4af37',
                            backgroundColor: 'rgba(212, 175, 55, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                ticks: { color: '#ffffff' }
                            },
                            x: {
                                grid: { color: 'rgba(255, 255, 255, 0.1)' },
                                ticks: { color: '#ffffff' }
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeInOutQuart'
                        }
                    }
                });
            }

            // Order Chart
            const orderCtx = document.getElementById('orderChart');
            if (orderCtx) {
                new Chart(orderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Delivered', 'Processing', 'Pending', 'Cancelled'],
                        datasets: [{
                            data: [
                                    {{ $orderDist['delivered'] }},
                                    {{ $orderDist['processing'] }},
                                    {{ $orderDist['pending'] }},
                                {{ $orderDist['cancelled'] }}
                            ],
                            backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#ef4444'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#ffffff' }
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeInOutQuart'
                        }
                    }
                });
            }
        });
    </script>
@endsection